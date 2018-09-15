<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User; 
use Input;
use Hash;
use Redirect;
use Validator;
use Illuminate\Support\Facades\DB;
use Mail;

class UsersController extends Controller
{
    protected $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function create(){
        return view('users/create');
    }

    public function store(){
        // go back and check Refactoring video
        $input = Input::all();
        $confirm_code = str_random(8);
        //$this->user->fill($input);
        $this->user->email = Input::get('email');
        $this->user->password = Hash::make(Input::get('password'));
        $this->user->confirm_code = $confirm_code;
        $email = $this->user->email;
        //$value = config('mail');
        //info($value);
        if(! $this->user->isValid($input))
		{
            return Redirect::back()->withInput($input)->withErrors($this->user->errors);
            //return ($this->user->errors);
        }
        
        $searchResult = DB::select("CALL getEmailExists('".$email. "', 0)");
        if (empty($searchResult))
            $this->user->save();
        else {
            $errors = array('email'=> array('Email is already taken.'));
            return Redirect::back()->withInput($input)->withErrors($errors);
        }

        $data = array('email' => $email, 'confirmationCode' => $confirm_code);
        /*Mail::send('emails.confirm', $data, function ($message)
        {

            $message->from('admin@vgmrad.io', 'Daniela Valadez');

            $message->to('8102c404a3-6ace2c@inbox.mailtrap.io');

        });*/

        return Redirect::route('users.index');
    }

    public function index(){
		$users = $this->user->all();
		// this is telling laravel to look in the resources/views/users/index.blade.php file
		//return view('users/index')->with('users', $users);
		// or for dynamic methods
		return view('users/index')->withUsers($users); // laravel assumes we are looking for a Users key
		// OR!!! 
		//return view('users/index', ['users' => $users]);
    }
    
    public function showActivate(){
        return view('activate/user');
    }

    public function activateAccount(){
        $searchResult = DB::select("CALL getEmailExists('".$email. "', 0)");
        return 1;
    }
}
