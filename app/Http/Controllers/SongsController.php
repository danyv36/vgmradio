<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Setup;
use App\Song;

class SongsController extends Controller
{
    public function home(){
        $setup = Setup::where('key', '=', 'songs_folder')->first();;
        $songs = Song::all();
        return view('index')->withSongs($songs)->with('songFolder', $setup); // laravel assumes we are looking for a songs key
        //return $setup;
    }
}
