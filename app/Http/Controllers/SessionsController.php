<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        // check first if account has been verified
        $email = Input::get('email');
        $searchResult = DB::select("CALL getEmailExists('".$email. "', 0)");
        $errors = '';
        //return $searchResult;
        if (!is_null($searchResult[0]->id)){
            // not null, user exists, check if account has been verified
            $validated = $searchResult[0]->validated;
            if ($validated == 1){
                // if email/pass is correct, store the session
                if (Auth::attempt(Input::only('email', 'password'))){
                    return Redirect::route('home');
                } else $errors = array('error' => 'Email or password are incorrect');
            } else $errors = array('error' => 'Email account has not been validated yet.'); // ask if they want another code and then redirect to activation page
        }
        else $errors = array('error' => 'Email does not exist');
        return Redirect::back()->withInput(Input::all())->withErrors($errors);
    }

    public function destroy(){
        // log out
        Auth::logout();
        return Redirect::route('home'); //redirect to login page
    }

}
