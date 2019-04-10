<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Image;
use App\History;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //return view('home');

        if (auth()->user()->isAdmin()) {
            return view('admin/dashboard');
        } else {
            return view('home');
        }
    }

    public function profile(){

        $currentuser = app('Illuminate\Contracts\Auth\Guard')->user();
        $user = User::find($currentuser->id)->toArray();
        $history = History::where('user_id', $currentuser->id)->get();
        //dd($history);
        return view('user.profile' , compact('user' , 'history'));
    }

    public function index_for_page(){
        $user = User::all()->toArray();
        return view('user.index', compact('user'));
    }

    public function edit($id){
        //dd($id);
        $user = User::find($id);
        return view('user.edit', compact('user', 'id'));

    }

    public function update(Request $request, $id){
        //dd($id);

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'point' => 'required',
            'money' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $new_name = "";
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $new_name = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(450, 400)->save(public_path('picture/user/' . $new_name));
            $user = user::find($id);
            $user->name = $request->get('name');
            $user->money = $request->get('money');
            $user->point = $request->get('point');
            $user->description = $request->get('description');
            $oldpruductname = $user->picture;
            $user->picture = $new_name;
            Storage::delete('user/'.$oldpruductname);
        } else {
            $user = user::find($id);
            $user->name = $request->get('name');
            $user->money = $request->get('money');
            $user->point = $request->get('point');
            $user->description = $request->get('description');
        }

        $user->save();

        return back()->with('success', 'success');

    }

    public function destroy($id){
        //dd($id);

        $user = User::find($id);
        $user_name = $user['email'];
        $oldusername = $user->picture;
        $user->delete();
        Storage::delete('user/'.$oldusername);

        return back()->with('success', $user_name . ' has deleted.');

    }

}
