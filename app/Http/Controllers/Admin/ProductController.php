<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\City;
use App\Models\Language;
use App\Models\Period;
use App\Models\Platform;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductTypes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Spatie\Image\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $platforms = Platform::all();
        $cities = City::all();
        $periods = Period::all();
        return view('admin.product.create', compact('categories','platforms', 'cities', 'periods'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|numeric|gt:0',
            'platform_id' => 'required|numeric|gt:0',
            'condition' => 'required',
            'city_id' => 'required|numeric|gt:0',
            'description' => 'required',
            'type' => 'required',
        ]);

        $types = $request->get('type');

        $product = new Product();
        $product->name = $request->get('name');
        $product->category_id = $request->get('category_id');
        $product->platform_id = $request->get('platform_id');
        $product->condition = $request->get('condition');
        $product->city_id = $request->get('city_id');
        $product->description = $request->get('description');
        $product->user_id = Auth::id();
        $product->created_by = Auth::id();
        $product->updated_by = Auth::id();

        if (count($types)>1) {
            $product->type = 'mix';
        }
        else{
            $product->type = $types[0];
        }
        if (in_array("sell", $types)) {
            $product->sell_price = $request->get('sell_price');
        }
        if (in_array("hire", $types)) {
            $product->hire_period_id = $request->get('hire_period_id');
            $product->hire_description = $request->get('hire_descriptions');
            $product->hire_price = $request->get('hire_price');
        }

        if (in_array("barter", $types)) {
            if ($request->get('barter_type') !== 0) {
                $product->barter_type = 'equal';
            }
            else{
                $product->barter_type = $request->get('barter_type');
            }
            $product->barter_money = $request->get('barter_price');
        }

        if ($product->save()) {

            if (count($types)>1) {
                foreach ($types as $type){
                    $add_type = new ProductTypes();
                    $add_type->product_id = $product->id;
                    $add_type->type = $type;
                    $add_type->save();
                }
            }

            if($request->file('img-1')){
                $filename = $_FILES['img-1']['tmp_name'];
                list($width, $height) = getimagesize($filename);
                if ($width>255 && $height>170) {
                    $image=$request->file('img-1');
                    $image_name=uniqid().'.'.$image->getClientOriginalExtension();
                    Image::load($request->file('img-1'))
                        ->width(254)
                        ->height(170)
                        ->save('uploads/products/'.$image_name);
                    $img = new ProductImage();
                    $img->product_id = $product->id;
                    $img->img = $image_name;
                    $img->default = 1;
                    $img->created_by = Auth::id();
                    $img->updated_by = Auth::id();
                    $img->save();
                }
                else{
                    return redirect()->back()->with('error', __('site.image-1_size'));
                }
            }
            if($request->file('img-2')){
                $filename = $_FILES['img-2']['tmp_name'];
                list($width, $height) = getimagesize($filename);
                if ($width>535 && $height>319) {
                    $image = $request->file('img-2');
                    $image_name = uniqid() . '.' . $image->getClientOriginalExtension();
                    Image::load($request->file('img-2'))
                        ->width(536)
                        ->height(320)
                        ->save('uploads/products/'.$image_name);
                    $img = new ProductImage();
                    $img->product_id = $product->id;
                    $img->img = $image_name;
                    $img->created_by = Auth::id();
                    $img->updated_by = Auth::id();
                    $img->save();
                }
                else{
                    return redirect()->back()->with('error', __('site.image-2_size'));
                }
            }

            return redirect()->route('product.index')->with('success','Product ads successfully created');
        }
        else{
            return redirect()->back()->withInput()->with('error', 'Something went wrong.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product_images = ProductImage::where('product_id', $product->id)->get();
        $images = [];
        foreach ($product_images as $img) {
            $images[] = $img->img;
        }
        return view('admin.product.show', compact('product', 'images'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $locales = Language::all();
        $cities = City::all();
        $platforms = Platform::all();
        $categories = Category::all();
        $periods = Period::all();
        $types = [];
        $product_images = ProductImage::where('product_id', $product->id)->orderBy('default','desc')->get();
        $images = [];
        foreach ($product_images as $img) {
            $images[] = $img->img;
        }

        if ($product->type == 'mix') {
            $product_types = ProductTypes::where('product_id', $product->id)->get();
            foreach ($product_types as $rel){
                $types[] = $rel->type;
            }
        }
        else{
            $types[] = $product->type;
        }

        return view('admin.product.edit', compact('product', 'locales', 'platforms', 'cities','categories', 'periods','types','images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|numeric|gt:0',
            'platform_id' => 'required|numeric|gt:0',
            'condition' => 'required',
            'city_id' => 'required|numeric|gt:0',
            'description' => 'required',
            'type' => 'required',
        ]);

        $types = $request->get('type');
        $product->name = $request->get('name');
        $product->category_id = $request->get('category_id');
        $product->platform_id = $request->get('platform_id');
        $product->condition = $request->get('condition');
        $product->city_id = $request->get('city_id');
        $product->description = $request->get('description');
        $product->updated_by = Auth::id();
        $product->status = $request->get('status');
        $product->ads_type = $request->get('ads_type');
        if ($request->get('deadline')){
            $product->premium_deadline = $request->get('deadline');
        }
        if (count($types)>1) {
            $product->type = 'mix';
        }
        else{
            $product->type = $types[0];
        }


        if (in_array("sell", $types)) {
            $product->sell_price = $request->get('sell_price');
        }
        if (in_array("hire", $types)) {
            $product->hire_period_id = $request->get('hire_period_id');
            $product->hire_description = $request->get('hire_descriptions');
            $product->hire_price = $request->get('hire_price');
        }

        if (in_array("barter", $types)) {
            if ($request->get('barter_type') !== 0) {
                $product->barter_type = 'equal';
            }
            else{
                $product->barter_type = $request->get('barter_type');
            }
            $product->barter_money = $request->get('barter_price');
        }


        if($request->file('img-1')){
            $filename = $_FILES['img-1']['tmp_name'];
            list($width, $height) = getimagesize($filename);
//                return $width.'----'.$height;
            if ($width>255 && $height>170) {
                $image=$request->file('img-1');
                $image_name=uniqid().'.'.$image->getClientOriginalExtension();
                if($width>$height)
                    Image::load($request->file('img-1'))
                        ->width(254)
                        ->height(170)
                        ->save('uploads/products/'.$image_name);
                else{
                    Image::load($request->file('img-1'))
                        ->height(170)
                        ->width(254)
                        ->save('uploads/products/'.$image_name);
                }
                $img = new ProductImage();
                $img->product_id = $product->id;
                $img->img = $image_name;
                $img->default = 1;
                $img->created_by = Auth::id();
                $img->updated_by = Auth::id();
                $img->save();

                $image = ProductImage::where('product_id', $product->id)->where('default', 1)->first();
                if ($image) {
                    if(File::exists('uploads/products/'.$image->img)){
                        File::delete('uploads/products/'.$image->img);
                    }
                    $image->delete();
                }
            }
            else{
                return redirect()->back()->with('error', __('site.image-1_size'));
            }

        }
        if($request->file('img-2')){
            $filename = $_FILES['img-2']['tmp_name'];
            list($width, $height) = getimagesize($filename);
            if ($width>535 && $height>319) {

                $image = $request->file('img-2');
                $image_name = uniqid() . '.' . $image->getClientOriginalExtension();
                Image::load($request->file('img-2'))
                    ->width(536)
                    ->height(320)
                    ->save('uploads/products/'.$image_name);
                $img = new ProductImage();
                $img->product_id = $product->id;
                $img->img = $image_name;
                $img->created_by = Auth::id();
                $img->updated_by = Auth::id();
                $img->save();

                $image = ProductImage::where('product_id', $product->id)->where('default', 0)->first();

                if ($image) {
                    if (File::exists('uploads/products/' . $image->img)) {
                        File::delete('uploads/products/' . $image->img);
                    }
                    $image->delete();
                }
            }
            else{
                return redirect()->back()->with('error', __('site.image-2_size'));
            }
        }

        if ($product->save()) {

            if (count($types)>1) {
                $new_types = [];
                $product_types = ProductTypes::where('product_id', $product->id)->get();
                foreach ($product_types as $rel){
                    $new_types[] = $rel->type;
                }
                if ($new_types !== $types ) {
                    DB::table('product_types')->where('product_id', $product->id)->delete();
                    foreach ($types as $type){
                        $add_type = new ProductTypes();
                        $add_type->product_id = $product->id;
                        $add_type->type = $type;
                        $add_type->save();
                    }
                }
            }


            return redirect()->route('product.index')->with('success','Product ads successfully updated');
        }
        else{
            return redirect()->back()->withInput()->with('error', 'Something went wrong.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($product->delete()) {
            $images = ProductImage::where('product_id', $product->id)->get();
            foreach ($images as $image){
                if(File::exists('uploads/products/'.$image->img)){
                    File::delete('uploads/products/'.$image->img);
                }
            }
            return redirect()->route('product.index')->with('success', 'Product successfully deleted');

        }
    }
}
