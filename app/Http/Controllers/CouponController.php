<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Promotion;
use App\User;
use App\Coupon;
use Illuminate\Support\Facades\Storage;

class CouponController extends Controller
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
    public function store($id)
    {
        //
        //dd($id);

        //function for random code
        $code = "";
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        $code =  implode($pass); //turn the array into a string
        //--------------------------------------------------------------------------------

        $promotion = Promotion::find($id);
        $currentuser = app('Illuminate\Contracts\Auth\Guard')->user();
        $user = User::find($currentuser->id);
        if ($user->point >= $promotion->point) {
            $user->point -= $promotion->point;
            $user->save();
        } else {
            return redirect()->back()->with("fail", "Your point id not enough");
        }



        $promotion->now_number++;
        $promotion->save();

        $coupon = new Coupon([

            'code' => $code,
            'user_id' => $user->id,
            'name' => $promotion->name,
            'picture' => $promotion->picture,
            'description' => $promotion->description,
            'min_money' => $promotion->min_money,
            'percent' => $promotion->percent,
            'discount' => $promotion->discount,

        ]);
        $coupon->save();



        return redirect()->back()->with("code", $code);
    }

    public function check(Request $request, $total)
    {
        //dd($total);
        //dd($request->get('coupon'));
        $coupon = Coupon::where('code', $request->coupon)->get();
        if (count($coupon)) {

            //return redirect()->back()->with('test' , 'Coupon found.');


            foreach ($coupon as $row) {

                if ($total < $row->min_money) {
                    return redirect()->back()->with('fail', 'the minimum money for coupon is ' . $row->min_money . ' baht.');
                }

                if ($row->percent > 0 && $row->discount > 0) {
                    return redirect()->back()->with('coupon_id' , $row->id)->with('percent', $row->percent)->with('discount', $row->discount)->with('found', 'Coupon found.');
                } else if ($row->percent > 0) {
                    return redirect()->back()->with('coupon_id' , $row->id)->with('percent', $row->percent)->with('found', 'Coupon found.');
                } else if ($row->discount > 0) {
                    return redirect()->back()->with('coupon_id' , $row->id)->with('discount', $row->discount)->with('found', 'Coupon found.');
                }
            }
        } else {

            return redirect()->back()->with('fail', 'Coupon not found.');
        }
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
