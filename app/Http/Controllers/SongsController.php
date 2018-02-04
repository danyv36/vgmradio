<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\Setup;
use App\Song;
use Auth;
use JavaScript;
use Input;

class SongsController extends Controller
{
    public function home(Request $request){
        $idUser = 0;
        $playlists = 0;
        $setup = Setup::where('key', '=', 'songs_folder')->first();
        //$songs = DB::table('songs')->paginate(15); // get songs only

        if (Auth::check()){
            $idUser = Auth::user()->id;
            JavaScript::put([
                'username' => Auth::user()->username,
                'idUser' => $idUser
            ]);
        }

        // for stored procedures, have to do pagination this way:
        // get likes for user if logged in
        $songs = DB::select('CALL getUserLikes('.$idUser.')');
        $page = Input::get('page', 1);  
        $paginate = 15;  
        $offSet = ($page * $paginate) - $paginate;  
        $itemsForCurrentPage = array_slice($songs, $offSet, $paginate, true);  
        $songs = new \Illuminate\Pagination\LengthAwarePaginator($itemsForCurrentPage, count($songs), $paginate, $page);

        // get user playlists
        if ($idUser > 0)
            $playlists = DB::table('playlists')->where('iduser', $idUser)->get();

        if ($request->ajax()) {
            return view('load')->withSongs($songs)->with('songFolder', $setup)->with('playlists', $playlists)->render();
        }
        return view('index')->withSongs($songs)->with('songFolder', $setup)->with('playlists', $playlists); // laravel assumes we are looking for a songs key
        //return $playlists;
    }
}
