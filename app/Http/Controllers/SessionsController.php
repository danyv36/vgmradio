<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use Hash;
use Redirect;
use Auth;
use JavaScript;

class SessionsController extends Controller
{
    /*public function __construct(){
        $this->middleware('auth', ['only' => 'create']);
    }*/

    public function create(){
        if (Auth::check()) //guest() if you're not signed in
            //return Redirect::to('/admin');
            return Redirect::route('home'); // redirect them to the home page, they're already signed in
        // show them the login screen, they're not signed in
        return view('sessions.create');
    }

    public function store(){
        // if username/pass is correct, store the session
        if (Auth::attempt(Input::only('username', 'password'))){
            //return Auth::user();
            //return "Welcome " . Auth::user()->username;
        
            return Redirect::route('home');
            //->with('user', Auth::user());
        }

        return Redirect::back()->withInput();
    }

    public function destroy(){
        // log out
        Auth::logout();
        return Redirect::route('home'); //redirect to login page
    }

}
