<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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

    public function index_for_page(){
        $user = User::all()->toArray();
        return view('user.index', compact('user'));
    }

    public function destroy($id){
        //dd($id);

        $user = User::find($id);
        $user_name = $user['email'];
        $user->delete();

        return back()->with('success', $user_name . ' has deleted.');

    }

}
