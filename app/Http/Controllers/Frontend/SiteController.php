<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use App\Models\City;
use App\Models\Discussion;
use App\Models\DiscussionCategory;
use App\Models\DiscussionComments;
use App\Models\PaymentMethod;
use App\Models\Period;
use App\Models\Platform;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductTypes;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Spatie\Image\Image;


class SiteController extends Controller
{
    public function setLocale(Request $request)
    {
        Session::put(['locale' => $request->get('locale')]);
        App::setLocale(Session::get('locale'));
        return redirect()->back();
    }

    public function index(){
        $premium_products = Product::where('ads_type', 'premium')->where('status', 'accepted')->orderBy('id','desc')->get();
        $general_products = Product::where('ads_type', 'general')->where('status', 'accepted')->orderBy('id','desc')->Paginate(100);

        return view('site.index', compact('premium_products','general_products'));
    }

    public function payments(){
        $methods = PaymentMethod::all();
        return view('site.payments', compact('methods'));
    }

    public function addAdvert(){
        $platforms = Platform::all();
        $cities = City::orderBy('name','asc')->get();
        $periods = Period::orderByRaw("FIELD(period, \"day\", \"week\", \"month\", \"year\")")->get();
        $categories = Category::all();

        return view('site.add-advert', compact('platforms', 'categories', 'periods','cities'));
    }


    public function createAds(Request $request){
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|numeric|gt:0',
            'platform_id' => 'required|numeric|gt:0',
            'condition' => 'required',
            'city_id' => 'required|numeric|gt:0',
            'description' => 'required',
            'type' => 'required',
            'img-1' => 'required',
            'img-2' => 'required',
        ]);

        DB::beginTransaction();
        $types = $request->get('type');

        $product = new Product();
        if (Auth::check()) {
            $user_id = Auth::id();
        }
        else {
            $user = new User();
            $user->name = $request->get('user_name');
            $user->surname = $request->get('user_surname');
            $user->email = $request->get('user_email');
            $user->password = Hash::make('12345678');
            $user->save();
            $user->assignRole('user');

            $user_id = $user->id;
        }

        $product->name = $request->get('name');
        $product->category_id = $request->get('category_id');
        $product->platform_id = $request->get('platform_id');
        $product->condition = $request->get('condition');
        $product->city_id = $request->get('city_id');
        $product->description = $request->get('description');

        $product->user_id = $user_id;
        $product->created_by = $user_id;
        $product->updated_by = $user_id;

        if(count($types)>1) {
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
            $product->hire_description = $request->get('hire_description');
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
            DB::commit();

            return redirect()->route('site.home')->with('success','Product ads successfully created');
        }
        else{
            return redirect()->back()->withInput()->with('error', 'Something went wrong.');
        }
    }


    public function product($slug)
    {
        $product = Product::where('slug', $slug)->first();
        if($product){
            $product_types = array_column(ProductTypes::where('product_id',$product->id)->select('type')->get()->toArray(),'type');
            $user_products = Product::where('user_id',$product->user_id)->where('id','<>',$product->id)->where('status','accepted')->get();
            $related_products = Product::where('category_id', $product->category_id)->where('id', '<>' , $product->id)->where('status','accepted')->get();
            $product->view = $product->view+1;
            $product->save();
            $image = ProductImage::where('product_id', $product->id)->where('default',0)->first();
            $img = $image->img;
            return view('site.product', compact('product', 'user_products', 'related_products', 'product_types', 'img'));

        }
        else{
            return redirect()->route('site.home');
        }
    }


    public function forum()
    {
        $discussions = Discussion::orderBy('id','desc')->get();
        return view('site.forum', compact('discussions'));
    }

    public function profile()
    {
        $user = User::find(Auth::id());
        $user_ads = Product::where('created_by', $user->id)->get();
        return view('site.my-profile', compact('user', 'user_ads'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'birthday' => ['required', 'date', 'max:255','before:2010-01-01'],
            'phone' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
        ],
            $messages = array(
                'name.required' => __('auth.name_required'),
                'surname.required' => __('auth.surname_required'),
                'birthday.required' => __('auth.birthday_required'),
                'phone.required' => __('auth.phone_required'),
                'password.required' => __('auth.password_required'),
                'birthday.before' => __('auth.birthday_before')
            ));
        $user = Auth::user();
        if(Hash::check($request->get('password'), $user->password)){
            if($request->get('new_pass')){
                $pass = Hash::make($request->get('new_pass'));
                $user->password = $pass;
            }
            $user->name = $request->get('name');
            $user->phone = $request->get('phone');
            $user->gender = $request->get('gender');
            $user->surname = $request->get('surname');
            $user->birthday = $request->get('birthday');
            $user->save();
            return redirect()->route('site.my-profile')->with('success', 'Profile successfully updated');
        }
        else{
            return redirect()->back()->withInput()->with('error', 'Password is not correct');
        }
    }

    public function userAdvert($id)
    {
        $platforms = Platform::all();
        $categories = Category::all();
        $cities = City::all();
        $ads = Product::where('id', $id)->where('created_by', Auth::id())->first();
        $img1 = ProductImage::where('product_id', $ads->id)->where('default', 1)->first();
        $img2 = ProductImage::where('product_id', $ads->id)->where('default', 0)->first();
        $periods = Period::orderByRaw("FIELD(period, \"day\", \"week\", \"month\", \"year\")")->get();
        if($ads){
            $types = [];
            if ($ads->type == 'mix') {
                $product_types = ProductTypes::where('product_id', $ads->id)->get();
                foreach ($product_types as $rel){
                    $types[] = $rel->type;
                }
            }else{
                $types[]=$ads->type;
            }
            return view('site.user-advert', compact('platforms', 'categories','cities', 'ads','types','img1','img2', 'periods'));
        }
        else{

            return redirect()->route('site.home')->with('error', 'Advertisement has not founded');
        }
    }


    public function forumInner($id,$slug)
    {
        $discussion = Discussion::where('id', $id)->where('slug', $slug)->first();
        if ($discussion) {
            $discussion->views = $discussion->views + 1;
            $discussion->save();
            $comments = DiscussionComments::where('discussion_id', $discussion->id)->get();
            return view('site.forum-inner', compact('discussion', 'comments'));
        }
        else{
            return redirect()->back();
        }
    }


    public function addComment(Request $request,$id, $slug)
    {
        if($request->get('content')){
            $comment = new DiscussionComments();
            $comment->created_by = Auth::id();
            $comment->discussion_id = $id;
            $comment->content = $request->get('content');
            $comment->save();
            $d = Discussion::find($id);
            $d->comments = DiscussionComments::where('discussion_id', $id)->count();
            $d->save();
            return redirect()->back()->with('success', 'site.comment successfully added');
        }
        else{
            return redirect()->back()->with('error', __('site.fill-comment-content'));
        }
    }


    public function createDiscussion(Request $request)
    {
        if (Auth::guest()){
            return redirect()->back();
        }
        $categories = DiscussionCategory::all();
        return view('site.create-discussion', compact('categories'));
    }


    public function addDiscussion(Request $request)
    {

        $request->validate([
            'subject' => 'required',
            'category' => 'required',
        ]);
        $d = new Discussion();

        if ($request->get('discussionEditor')) {
            $d->content = $request->get('discussionEditor');
        }else{
            $d->content = '';
        }
        $d->title = $request->get('subject');
        $d->category_id = $request->get('category');
        $d->created_by = Auth::id();
        $d->save();
        return redirect()->route('site.forum')->with('success', 'Your discussion has been created');
    }


    public function categories()
    {
        $categories = Category::all();
        return view('site.categories', compact('categories'));
    }


    public function consoles()
    {
        $platforms = Platform::all();
        return view('site.platforms', compact('platforms'));
    }


    public function categoryProducts($id)
    {
        $category = Category::find($id);
        if($category){
            $premium_products = Product::where('status', 'accepted')->orderby('id','desc')->where('ads_type', 'premium')->where('category_id', $category->id)->get();
            $general_products = Product::where('status', 'accepted')->orderby('id','desc')->where('category_id',$category->id)->where('ads_type', 'general')->get();
            return view('site.product-via-query', compact('premium_products', 'general_products'));
        }
        else{
            return redirect()->route('site.home');
        }
    }


    public function consoleProducts($id)
    {
        $platform = Platform::find($id);
        if($platform){
            $premium_products = Product::where('status', 'accepted')->orderby('id','desc')->where('ads_type', 'premium')->where('platform_id', $platform->id)->get();
            $general_products = Product::where('status', 'accepted')->orderby('id','desc')->where('platform_id',$platform->id)->where('ads_type', 'general')->get();
            return view('site.product-via-query', compact('premium_products', 'general_products'));
        }
        else{
            return redirect()->route('site.home');
        }
    }


    public function advertisements()
    {
        $products = Product::orderByRaw("FIELD(ads_type, \"premium\", \"genere\")")->orderby('id', 'desc')->where('status', 'accepted')->paginate(100);
        $categories = Category::all();
        $platforms = Platform::all();
        return view('site.advertisements', compact('products', 'categories', 'platforms'));
    }


    public function filterProducts(Request $request)
    {
        $platform = $request->get('platform');
        $category = $request->get('category');
        $filter = $request->get('filter');
        if($filter == 'sell'){

            $query = "FIELD(type, \"sell\", \"hire\", \"barter\", \"mix\")";
        }
        else if($filter == 'barter'){
            $query = "FIELD(type, \"barter\", \"hire\", \"sell\", \"mix\")";

        }
        else if($filter == 'hire'){
            $query = "FIELD(type, \"hire\", \"sell\", \"barter\", \"mix\")";
        }
        else{
            $query = "FIELD(type, \"sell\", \"hire\", \"barter\", \"mix\" )";
        }

        if($platform == 0 and $category == 0) {

//                $products = Product::orderByRaw("FIELD(ads_type, \"premium\", \"general\")")->orderByRaw("FIELD(type,".$filter)->orderby('id', 'desc')->where('status', 'accepted')->paginate(100);
                $products = Product::orderByRaw($query)->orderby('id', 'desc')->where('status', 'accepted')->paginate(100);

        }

        else if($platform != 0 and  $category == 0 ){

//                $products = Product::orderByRaw("FIELD(ads_type, \"premium\", \"general\")")->orderByRaw("FIELD(type,".$filter)->orderby('id', 'desc')->where('platform_id', $platform)->where('status', 'accepted')->paginate(100);
                $products = Product::orderByRaw("FIELD(type, ".$query.")")->orderby('id', 'desc')->where('platform_id', $platform)->where('status', 'accepted')->paginate(100);



        }
        else if($platform == 0 and $category !=0 ){
//                $products = Product::orderByRaw("FIELD(ads_type, \"premium\", \"general\")")->orderByRaw("FIELD(type,".$filter)->orderby('id', 'desc')->where('category_id', $category)->where('status', 'accepted')->paginate(100);
                $products = Product::orderByRaw($query)->orderby('id', 'desc')->where('category_id', $category)->where('status', 'accepted')->paginate(100);

        }


        else{
//                $products = Product::orderByRaw("FIELD(ads_type, \"premium\", \"general\")")->orderByRaw("FIELD(type,".$filter)->orderby('id', 'desc')->where('category_id', $category)->where('platform_id', $platform)->where('status', 'accepted')->paginate(100);
                $products = Product::orderByRaw($query)->orderby('id', 'desc')->where('category_id', $category)->where('platform_id', $platform)->where('status', 'accepted')->paginate(100);

        }

        return view('site.partials.products', compact('products'));

    }


    public function updateUserAdvert(Request $request)
    {
        $product = Product::find($request->id);
        if($product){

            $product->name = $request->get('name');
            $product->category_id = $request->get('category_id');
            $product->platform_id = $request->get('platform_id');
            $product->condition = $request->get('condition');
            $product->city_id = $request->get('city_id');
            $product->description = $request->get('description');
            $product->updated_by = Auth::id();

            $types = $request->type;
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
                $product->hire_description = $request->get('hire_description');
                $product->hire_price = $request->get('hire_price');
            }

            if (in_array("barter", $types)) {
                if ($request->get('barter-radio') == 'equal') {
                    $product->barter_type = 'equal';
                }
                else{
                    $product->barter_type = $request->get('barter-radio');
                }
                $product->barter_money = $request->get('barter_money');
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


            if($product->save()) {
                if(count($types) > 1) {
                    $new_types = [];
                    $product_types = ProductTypes::where('product_id', $product->id)->get();
                    foreach ($product_types as $rel) {
                        $new_types[] = $rel->type;
                    }
                    if ($new_types !== $types) {
                        DB::table('product_types')->where('product_id', $product->id)->delete();
                        foreach ($types as $type) {
                            $add_type = new ProductTypes();
                            $add_type->product_id = $product->id;
                            $add_type->type = $type;
                            $add_type->save();
                        }
                    }
                }
                return redirect()->route('site.my-profile')->with('success', 'Your Advertisement has been updated');
            }


        }
        else{
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

}
