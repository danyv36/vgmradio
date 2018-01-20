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
        $setup = Setup::where('key', '=', 'songs_folder')->first();;

        if (Auth::check()){
            JavaScript::put([
                'username' => Auth::user()->username,
                'idUser' => Auth::user()->id
            ]);

            // for stored procedures, have to do pagination this way:
            // get likes for user if logged in
            $songs = DB::select('CALL getUserLikes('.Auth::user()->id.')');
            $page = Input::get('page', 1);  
            $paginate = 15;  
            $offSet = ($page * $paginate) - $paginate;  
            $itemsForCurrentPage = array_slice($songs, $offSet, $paginate, true);  
            $songs = new \Illuminate\Pagination\LengthAwarePaginator($itemsForCurrentPage, count($songs), $paginate, $page); 
        }
        else{
            $songs = DB::table('songs')->paginate(15); // get songs only
        }

        if ($request->ajax()) {
            return view('load')->withSongs($songs)->with('songFolder', $setup)->render();  
        }
        return view('index')->withSongs($songs)->with('songFolder', $setup); // laravel assumes we are looking for a songs key
    }
}
