<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\Setup;
use App\Song;

class SongsController extends Controller
{
    public function home(Request $request){
        $setup = Setup::where('key', '=', 'songs_folder')->first();;
        $songs = DB::table('songs')->paginate(15);
        //$songs = Song::all()->paginate(5);
        if ($request->ajax()) {
            return view('load')->withSongs($songs)->with('songFolder', $setup)->render();  
        }
        return view('index')->withSongs($songs)->with('songFolder', $setup); // laravel assumes we are looking for a songs key
        //return $setup;
    }
}
