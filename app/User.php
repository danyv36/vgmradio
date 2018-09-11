<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;

class User extends Authenticatable
{

    //public $timestamps = false; // to tell laravel that my table doesn't have timestamps
    public static $rules = array(
        'email'    => 'required|email', // make sure the email is an actual email
        'confirm-email'    => 'required|email|same:email',
        'password' => 'required|alphaNum|min:3', // password can only be alphanumeric and has to be greater than 3 characters
        'confirm-password' => 'required|alphaNum|min:6|same:password'
    );

    public static $messages = [
        'confirm-email.same' => 'E-mails should match.',
        'confirm-password.same' => 'Passwords should match.',
        'confirm-password.min' => 'Password should be at least 6 characters long'
    ];

    public $errors;

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'confirm_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'confirm-password', 'remember_token'
    ];

    public function isValid($data){
		$validation = Validator::make($data, static::$rules, static::$messages);
		if ($validation->passes()){
			return true;
		}
		$this->errors = $validation->messages();
		return false;
	}
}
