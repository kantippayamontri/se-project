<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Out_of_stock;
use App\Used_to;
use App\User;
use Illuminate\Support\Facades\Storage;

class Out_of_stockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $out_of_stock = Out_of_stock::all()->toArray();
        return view('out_of_stock.index', compact('out_of_stock'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        //
        //dd($id);
        $out_of_stock = Out_of_stock::find($id);
        $name = $out_of_stock->name;

        $product = new Product([

            'name' => $out_of_stock->name,
            'price' => $out_of_stock->price,
            'point' => $out_of_stock->point,
            'category' => $out_of_stock->category,
            'picture' => $out_of_stock->picture,

        ]);
        $product->save();

        $out_of_stock->delete();

        return redirect()->back()->with('success' , $name.' add to product.');


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
        //dd($id);
        $out_of_stock = Out_of_stock::find($id);
        return view('out_of_stock.edit', compact('out_of_stock', 'id'));
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
       // dd($request);
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
            $out_of_stock = Out_of_stock::find($id);
            $out_of_stock->name = $request->get('name');
            $out_of_stock->price = $request->get('price');
            $out_of_stock->point = $request->get('point');
            $out_of_stock->category = $request->get('category');
            $oldpruductname = $out_of_stock->picture;
            $out_of_stock->picture = $new_name;
            Storage::delete('product/'.$oldpruductname);
        } else {
            $out_of_stock = Out_of_stock::find($id);
            $out_of_stock->name = $request->get('name');
            $out_of_stock->price = $request->get('price');
            $out_of_stock->point = $request->get('point');
            $out_of_stock->category = $request->get('category');
        }

        $out_of_stock->save();
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
        $out_of_stock = Out_of_stock::find($id);
        $out_of_stock_name = $out_of_stock['name'];
        $oldout_of_stock_name = $out_of_stock->picture;
        $out_of_stock->delete();
        Storage::delete('product/'.$oldout_of_stock_name);

        return back()->with('success', $out_of_stock_name . ' has deleted.');

    }


    public function tell($id)
    {
        //dd($id);

        $product = Product::find($id);
        $currentuser = app('Illuminate\Contracts\Auth\Guard')->user();
        if ($product->out_of_stock + 1 < 3) {

            $user = User::find($currentuser->id);
            $user->point =  $user->point+20;
            $user->save();

            $use_to = new Used_to([
                'out_of_stock_id' => $product->id,
                'user_id' => $currentuser->id,
            ]);
            $use_to->save();


            $product->out_of_stock++;
            $product->save();
            return redirect()->back()->with('test', '<3');
        } else {

            $out_of_stock = new Out_of_stock([

                'name' => $product->name,
                'price' => $product->price,
                'point' => $product->point,
                'category' => $product->category,
                'picture' => $product->picture,

            ]);

            $out_of_stock->save();
            $product->delete();
            return redirect()->back()->with('test', '=3');
        }
    }
}
