<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\Storage;
use App\Promotion;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $promotion = Promotion::all()->toArray();
        return view('promotion.index', compact('promotion'));
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
    public function store(Request $request)
    {
        //
        //dd($request);
        $this->validate($request, [
            'name' => 'required|string',
            'description'  => '',
            'number' => 'required|integer',
            'point' => 'required|integer',
            'min_money'  => 'required|integer|min:0',
            'percent'  => 'required|integer|between:0,100',
            'discount'  => 'required|integer|min:0',
            'picture'  => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $new_name = 'no.png';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $new_name = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(450, 400)->save(public_path('picture/promotion/' . $new_name));
        }

        $promotion = new Promotion([

            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'now_number' => 0,
            'number' => $request->get('number'),
            'min_money' => $request->get('min_money'),
            'point' => $request->get('point'),
            'percent' => $request->get('percent'),
            'discount' => $request->get('discount'),
            'picture' => $new_name,

        ]);

        $promotion->save();

        return back()->with('success', 'success');
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
        $promotion = Promotion::find($id)->toArray();
        return view('promotion.editpromotion', compact('promotion', 'id'));
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
        //dd($request);

        $this->validate($request, [
            'name' => 'required|string',
            'description'  => '',
            'number' => 'required|integer',
            'point' => 'required|integer|min:0',
            'min_money'  => 'required|integer|min:0',
            'percent'  => 'required|integer|between:0,100',
            'discount'  => 'required|integer|min:0',
            'picture'  => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        

        $new_name = "";
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $new_name = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(450, 400)->save(public_path('picture/promotion/' . $new_name));
           
            $promotion = Promotion::find($id);
            $promotion->name = $request->get('name');
            $promotion->description = $request->get('description');
            $promotion->number = $request->get('number');
            $promotion->min_money = $request->get('min_money');
            $promotion->percent = $request->get('percent');
            $promotion->discount = $request->get('discount');
            $promotion->point = $request->get('point');
            $oldpromotionname = $promotion->picture;
            $promotion->picture = $new_name;
            Storage::delete('promotion/' . $oldpromotionname);
        } else {
            $promotion = Promotion::find($id);
            $promotion = Promotion::find($id);
            $promotion->name = $request->get('name');
            $promotion->description = $request->get('description');
            $promotion->number = $request->get('number');
            $promotion->min_money = $request->get('min_money');
            $promotion->percent = $request->get('percent');
            $promotion->discount = $request->get('discount');
            $promotion->point = $request->get('point');
        }

        $promotion->save();
        return back()->with('success', 'Edit promotion success');

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

        $promotion  = Promotion::find($id);
        $promotion_name = $promotion->name;
        $oldpromotionname = $promotion->picture;
        $promotion->delete();
        Storage::delete('promotion/' . $oldpromotionname);

        return redirect()->route('promotion.index')->with('delete', $promotion_name);
    }
}
