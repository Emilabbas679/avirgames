<?php

namespace App\Http\Controllers\Admin;

use App\Models\DiscussionCategory;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class DiscussionCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = DiscussionCategory::all();
        return view('admin.discussion-category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locales = Language::all();
        return view('admin.discussion-category.create', compact('locales'));
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

        ]);
        $image_name = '';
        if($request->file('img')) {
            $image=$request->file('img');
            $image_name=uniqid().'.'.$image->getClientOriginalExtension();
            $image->move('uploads/discussion-category',$image_name);
        }

        $icon = '';
        if ($request->get('icon')){
            $icon = $request->get('icon');
        }


        $category = new DiscussionCategory();
        $category->name = $request->get('name');
        $category->img = $image_name;
        $category->icon = $icon;
        $category->created_by = Auth::id();
        $category->updated_by = Auth::id();
        $category->save();

        return redirect()->route('discussion-category.index')->with('success', 'successfully created');
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
    public function edit($id)
    {
        $category = DiscussionCategory::find($id);
        $locales = Language::all();
        return view('admin.discussion-category.edit', compact('category','locales'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|array|min:1',

        ]);
        $category = DiscussionCategory::find($id);

        $image_name = '';
        if($request->file('img')) {
            $image=$request->file('img');
            $image_name=uniqid().'.'.$image->getClientOriginalExtension();
            $image->move('uploads/discussion-category',$image_name);

            if ($category->img !== '') {
                if(File::exists('uploads/discussion-category/'.$category->img)){
                    File::delete('uploads/discussion-category/'.$category->img);
                }
            }
        }

        $icon = '';
        if ($request->get('icon')){
            $icon = $request->get('icon');
        }
        $category->name = $request->get('name');
        $category->img = $image_name;
        $category->icon = $request->get('icon');
        $category->updated_by = Auth::id();
        $category->save();

        return redirect()->route('discussion-category.index')->with('success', 'successfully created');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = DiscussionCategory::find($id);
        if ($category->img !== '') {
            if(File::exists('uploads/discussion-category/'.$category->img)){
                File::delete('uploads/discussion-category/'.$category->img);
            }
        }
        $category->delete();
        return redirect()->route('discussion-category.index')->with('success', 'Successfully deleted');
    }
}
