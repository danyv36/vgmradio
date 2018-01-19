<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use Hash;
use Redirect;
use Auth;

class SessionsController extends Controller
{
    /*public function __construct(){
        $this->middleware('auth', ['only' => 'create']);
    }*/

    public function create(){
        if (Auth::check()) //guest() if you're not signed in
            //return Redirect::to('/admin');
            return Redirect::route('home');
        return view('sessions.create');
    }

    public function store(){
        if (Auth::attempt(Input::only('username', 'password'))){
            //return Auth::user();
            //return "Welcome " . Auth::user()->username;
            return Redirect::route('home');
        }

        return Redirect::back()->withInput();
    }

    public function destroy(){
        Auth::logout();
        return Redirect::route('home'); //redirect to login page
    }

}
