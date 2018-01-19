<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;

class User extends Authenticatable
{
    //public $timestamps = false; // to tell laravel that my table doesn't have timestamps

    public static $rules = array(
        'username'    => 'required', // make sure the email is an actual email
        'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
    );

    public static $messages;

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function isValid($data){
		$validation = Validator::make($data, static::$rules);
		if ($validation->passes()){
			return true;
		}
		static::$messages = $validation->messages();
		return false;
	}
}
