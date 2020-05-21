<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locales = Language::all();
        $categories = Category::all();
        return view('admin.category.create', compact('locales','categories'));
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
            'name' => 'required|array|min:1',
            'parent_id' => 'required',
            'img' => 'required',
        ]);
        $category = new Category();
        $category->name = $request->get('name');
        $category->parent_id = $request->get('parent_id');

        $image=$request->file('img');
        $image_name=uniqid().'.'.$image->getClientOriginalExtension();
        $image->move('uploads/category',$image_name);

        $category->img = $image_name;
        $category->created_by = $request->get('created_by');
        $category->updated_by = $request->get('updated_by');
        $category->save();
        return redirect()->route('category.index')
            ->with('success', 'Category added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categories = Category::all();
        $locales = Language::all();
        return view('admin.category.edit', compact('locales','category','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|array|min:1',
            'parent_id' => 'required',
        ]);
        $category->name = $request->get('name');
        $category->parent_id = $request->get('parent_id');
        $category->updated_by = Auth::id();
        if ($request->file('img')){
            if(File::exists('uploads/category/'.$category->img)){
                File::delete('uploads/category/'.$category->img);
            }
            $image=$request->file('img');
            $image_name=uniqid().'.'.$image->getClientOriginalExtension();
            $image->move('uploads/category',$image_name);
            $category->img = $image_name;
        }

        $category->save();
        return redirect()->route('category.index')
            ->with('success', 'Category name updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if(File::exists('uploads/category/'.$category->img)){
            File::delete('uploads/category/'.$category->img);
        }
        $category->delete();
        return redirect()->route('category.index')
            ->with('success', 'Category name deleted');
    }
}
