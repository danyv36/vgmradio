<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User; 
use Input;
use Hash;
use Redirect;
use Validator;

class UsersController extends Controller
{
    public function create(){
        return view('users/create');
    }

    public function store(){
        // go back and check Refactoring video

        if(! User::isValid(Input::all()))
		{
			return Redirect::back()->withInput()->withErrors(User::$messages);
		}

        $user = new User;
        //Input is from the Form input
        $user->username = Input::get('username');
        $user->password = Hash::make(Input::get('password'));
        $user->save();

        return Redirect::route('users.index');
    }

    public function index(){
		$users = User::all();
		// this is telling laravel to look in the resources/views/users/index.blade.php file
		//return view('users/index')->with('users', $users);
		// or for dynamic methods
		return view('users/index')->withUsers($users); // laravel assumes we are looking for a Users key
		// OR!!! 
		//return view('users/index', ['users' => $users]);
	}
}
