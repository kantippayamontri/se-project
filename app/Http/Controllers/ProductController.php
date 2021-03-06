<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Used_to;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //เข้าก่อน
        $currentuser = app('Illuminate\Contracts\Auth\Guard')->user();
        $product = Product::all()->toArray();
       
        //dd($used_to);
        if (is_null(auth()->user()) || auth()->user()->isAdmin()) {
            return view('product', compact('product'));
        } else { 
            $used_to = Used_to::where('user_id', $currentuser->id)->get();
            return view('user.product', compact('product', 'used_to'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('addproduct');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'point' => 'required',
            'category' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $new_name = 'no.png';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $new_name = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(450, 400)->save(public_path('picture/product/' . $new_name));
        }

        $product = new Product([

            'name' => $request->get('name'),
            'price' => $request->get('price'),
            'point' => $request->get('point'),
            'category' => $request->get('category'),
            'picture' => $new_name,

        ]);

        $product->save();

        return back()->with('success', 'success')->with('path', $new_name);
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
        //
        $product = Product::find($id);
        //dd($id);
        return view('product.editproduct', compact('product', 'id'));
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
        //
        //dd($id);
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'point' => 'required',
            'category' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $new_name = "";
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $new_name = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(450, 400)->save(public_path('picture/product/' . $new_name));
            $product = Product::find($id);
            $product->name = $request->get('name');
            $product->price = $request->get('price');
            $product->point = $request->get('point');
            $product->category = $request->get('category');
            $oldpruductname = $product->picture;
            $product->picture = $new_name;
            Storage::delete('product/' . $oldpruductname);
        } else {
            $product = Product::find($id);
            $product->name = $request->get('name');
            $product->price = $request->get('price');
            $product->point = $request->get('point');
            $product->category = $request->get('category');
        }

        $product->save();
        return back()->with('success', 'Edit data success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        //dd($id);
        $product = Product::find($id);
        $product_name = $product['name'];
        $oldpruductname = $product->picture;
        $product->delete();
        Storage::delete('product/' . $oldpruductname);

        return back()->with('success', $product_name . ' has deleted.');
    }

    public function search(Request $request)
    {
        //dd($request);
        $word = $request->get('search_text');
        $cat = $request->get('category');
        if ($request->get('search_text')) {

            if ($cat != '0') {
                $product = Product::
                    where('name', 'like', '%' . $word . '%')
                    ->Where('category',$cat)
                    -> get();
                    //dd($product);  
            }else{
                $product =Product::
                    where('name', 'like', '%' . $word . '%')
                    -> get();   
                
                    //dd($product);   
            }

        } else {

            if ($cat != 0 ) { 
                $product = Product::
                    Where('category', 'like', '%' . $cat . '%')
                    -> get();
                //dd($product);
            }else{
                $product = Product::all()->toArray();
                return redirect()->route('product');
                //dd($product);
            }
        }

        $currentuser = app('Illuminate\Contracts\Auth\Guard')->user();
        $used_to = Used_to::where('user_id', $currentuser->id)->get();
        if (is_null(auth()->user()) || auth()->user()->isAdmin()) {
            return view('product', compact('product')) ->with('search' , 'eiei');
        } else {
            return view('user.product', compact('product', 'used_to'))->with('search' , 'eiei');
        }



    }
}
