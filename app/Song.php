<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Song extends Authenticatable
{
    public $timestamps = true; // to tell laravel that my table has timestamps

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ // which fields may be mass assigned
        'title', 'game', 'composer', 'song_filename', 'ost_img_filename', 'is_relaxing'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    /*protected $hidden = [
        'password', 'remember_token',
    ];*/
}
