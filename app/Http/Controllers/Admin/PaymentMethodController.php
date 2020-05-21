<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use App\Models\PaymentMethod;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $methods = PaymentMethod::all();
        return view('admin.payment-method.index', compact('methods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locales = Language::all();
        return view('admin.payment-method.create', compact('locales'));
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
            'img' => 'required'
        ]);
            $image=$request->file('img');
            $image_name=uniqid().'.'.$image->getClientOriginalExtension();
            $image->move('uploads/payment-methods',$image_name);
            $method = new PaymentMethod();
            $method->name = $request->get('name');
            $method->img = $image_name;
            $method->created_by = Auth::id();
            $method->updated_by = Auth::id();
            $method->save();
        return redirect()->route('payment-method.index')
            ->with('success', 'Method added');
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
        $method = PaymentMethod::find($id);
        $locales = Language::all();
        return view('admin.payment-method.edit', compact('locales', 'method'));
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
        $method = PaymentMethod::find($id);
        if($request->file('img')){
            $image = $method->img;
            if ($image) {
                if(File::exists('uploads/payment-methods/'.$image)){
                    File::delete('uploads/payment-methods/'.$image);
                }
            }
            $image=$request->file('img');
            $image_name=uniqid().'.'.$image->getClientOriginalExtension();
            $image->move('uploads/payment-methods',$image_name);
            $method->img = $image_name;
        }
        $method->name = $request->get('name');
        $method->updated_by = Auth::id();
        $method->save();
        return redirect()->route('payment-method.index')->with('success', 'Method Successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $method = PaymentMethod::find($id);
        $image = $method->img;
        if(File::exists('uploads/payment-methods/'.$image)){
            File::delete('uploads/payment-methods/'.$image);
        }
        $method->delete();
        return redirect()->route('payment-method.index')->with('success', 'Method successfully deleted');
    }
}
