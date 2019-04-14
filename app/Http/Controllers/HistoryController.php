<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\User;
use App\History;
use App\Coupon;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store($total_price, $total_point, $coupon_id)
    {
        //return view('welcome');

        $cart = Cart::all();
        //dd($cart);
        $currentuser = app('Illuminate\Contracts\Auth\Guard')->user();

        //var for store in history table
        $his_cart = date('Y-m-d H:i:s');

        foreach ($cart as $data) {
            //dd($data);
            //    $x = Cart::find($data->id);
            //    $x->delete();

            $history = new History([

                'cart' => $his_cart,
                'time' => $his_cart,
                'user_id' => $currentuser->id,
                'name' => $data->name,
                'quantity' => $data->quantity,
                'total_price' => $data->total_price,
                'total_point' => $data->total_point,
            ]);
            $history->save();
            //delete data in cart 
            $already_save = Cart::find($data->id);
            $already_save->delete();
        }

        if ($coupon_id !== 0) {
            $coupon = Coupon::find($coupon_id);
            $coupon->delete();
        }


        //money and point of user must change
        $user = User::find($currentuser->id);
        $user->money -= $total_price;
        $user->point += $total_point;
        $user->save();



        return redirect()->route('cart');
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
    }
}
