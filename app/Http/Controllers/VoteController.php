<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vote;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\Storage;
use App\Vote_User;
use App\Product;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $vote = Vote::all()->toArray();
        $currentuser = app('Illuminate\Contracts\Auth\Guard')->user();
        $vote_user = Vote_User::where('user_id', $currentuser->id)->get();
        return view('vote.index', compact('vote' , 'vote_user'));
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
        if( $request->get('category')==='Choose...'){
            return redirect()->back()->with('fail' , 'Please choose category');
        }
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

        $vote = new Vote([

            'name' => $request->get('name'),
            'price' => $request->get('price'),
            'point' => $request->get('point'),
            'category' => $request->get('category'),
            'picture' => $new_name,
            'number' => 0,

        ]);

        $vote->save();

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
        //dd($id);

        $vote = Vote::find($id);
        return view('vote.edit', compact('vote', 'id'));
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
            $vote = Vote::find($id);
            $vote->name = $request->get('name');
            $vote->price = $request->get('price');
            $vote->point = $request->get('point');
            $vote->category = $request->get('category');
            $oldpruductname = $vote->picture;
            $vote->picture = $new_name;
            Storage::delete('product/' . $oldpruductname);
        } else {
            $vote = Vote::find($id);
            $vote->name = $request->get('name');
            $vote->price = $request->get('price');
            $vote->point = $request->get('point');
            $vote->category = $request->get('category');
        }

        $vote->save();
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

        $vote = Vote::find($id);
        $vote_name = $vote['name'];
        $oldvotename = $vote->picture;
        $vote->delete();
        Storage::delete('product/'.$oldvotename);

        return back()->with('success', $vote_name . ' has deleted.');

    }

    public function vote_($id){
        //dd($id);

        $vote = Vote::find($id);
        $vote->number += 1;
        $vote->save();

        $currentuser = app('Illuminate\Contracts\Auth\Guard')->user();
        $vote_user = new Vote_User([

            'user_id' => $currentuser->id,
            'vote_id' => $id,

        ]);

        $vote_user->save();

        return redirect()->back()->with("success" , "You vote ".$vote->name." success.");
        
    }

    public function add_to_product($id){

        //dd($id);
        $currentuser = app('Illuminate\Contracts\Auth\Guard')->user();
        $vote = Vote::find($id);

        $product = new Product([

            'name' => $vote->name,
            'price' => $vote->price,
            'point' => $vote->point,
            'category' => $vote->category,
            'picture' => $vote->picture,

        ]);
        $product->save();

        $vote_user = Vote_User::where('vote_id', $vote->id)->get();
        foreach($vote_user as $row){
            $data = Vote_User::find($row->id);
            $data->delete();
        }

        $name = $vote->name;

        $vote->delete();

        return redirect()->back()->with('success' , $name." is add to product");

    }


}
