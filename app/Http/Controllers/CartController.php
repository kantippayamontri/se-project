<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $cart = Cart::all()->toArray();
        return view('cart.index', compact('cart'));
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
    public function store(Request $request, $id)
    {
        //
        //dd($request);
        $product = Product::find($id);
        $cart;
        if (Cart::find($id)) {

            $cart = Cart::find($id);
            $cart->quantity +=  $request->get('number');
            $cart->total_price = $cart->quantity * $cart->price;
            $cart->total_point = $cart->quantity * $cart->point;
        } else {
            $cart = new Cart([

                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'point' => $product->point,
                'total_price' => $product->price * $request->get('number'),
                'total_point' => $product->point * $request->get('number'),
                'picture' => $product->picture,
                'quantity' => $request->get('number'),

            ]);
        }



        $cart->save();

        return back()->with('success', 'success')->with('path', $product->name);
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
        $cart = Cart::find($id);
        $cart_name = $cart->name;
        $cart->delete();

        return back()->with('success', $cart_name . ' has deleted.');
    }


    public function plus($id)
    {
        //dd($id);

        $cart = Cart::find($id);
        $cart->quantity += 1;
        $cart->total_price = $cart->quantity * $cart->price;
        $cart->total_point = $cart->quantity * $cart->point;


        $cart->save();

        return redirect()->route('cart');
    }

    public function minus($id)
    {
        //dd($id);
        $cart = Cart::find($id);
        if ($cart->quantity > 1) {
            $cart->quantity -= 1;
            $cart->total_price = $cart->quantity * $cart->price;
            $cart->total_point = $cart->quantity * $cart->point;
        }
        $cart->save();
        return  redirect()->route('cart');
    }
}
