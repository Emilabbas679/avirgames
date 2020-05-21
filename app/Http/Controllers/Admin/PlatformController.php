<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use App\Models\Platform;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PlatformController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $platforms = Platform::all();
        return view('admin.platform.index', compact('platforms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locales = Language::all();
        $platforms = Platform::all();
        return view('admin.platform.create', compact('locales', 'platforms'));
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
            'parent' => 'required',
            'img' => 'required',

        ]);
        $p = new Platform();
        $p->name = $request->get('name');
        $p->parent = $request->get('parent');
        $p->created_by = Auth::id();
        $p->updated_by = Auth::id();

        $image=$request->file('img');
        $image_name=uniqid().'.'.$image->getClientOriginalExtension();
        $image->move('uploads/platform',$image_name);

        $p->img = $image_name;
        $p->save();

        return redirect()->route('platform.index')
            ->with('success', 'platform added');
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
    public function edit(Platform $platform)
    {
        $locales = Language::all();
        $platforms = Platform::all();
        return view('admin.platform.edit', compact('locales','platform', 'platforms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Platform $platform)
    {
        $request->validate([
            'name' => 'required|array|min:1',
            'parent' => 'required',
        ]);

        if ($request->file('img')){
            if(File::exists('uploads/platform/'.$platform->img)){
                File::delete('uploads/platform/'.$platform->img);
            }
            $image=$request->file('img');
            $image_name=uniqid().'.'.$image->getClientOriginalExtension();
            $image->move('uploads/platform',$image_name);
            $platform->img = $image_name;
        }

        $platform->name = $request->get('name');
        $platform->parent = $request->get('parent');
        $platform->updated_by = Auth::id();
        $platform->save();
        return redirect()->route('platform.index')
            ->with('success', 'Platform name updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Platform $platform)
    {
        if(File::exists('uploads/platform/'.$platform->img)){
            File::delete('uploads/platform/'.$platform->img);
        }
        $platform->delete();
        return redirect()->route('platform.index')
            ->with('success', 'Platform name deleted');
    }
}
