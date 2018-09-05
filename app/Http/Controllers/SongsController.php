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
use Response;

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
            return view('partial.load')->withSongs($songs)
                ->with('songFolder', $setup)
                ->with('playlists', $playlists)
                ->with('msg', '-1')
                ->render();
        }
        return view('index')->withSongs($songs)
                ->with('songFolder', $setup)
                ->with('playlists', $playlists)
                ->with('msg', '-1');
    }

    public function search(Request $request){
        $playlists = 0;
        $setup = Setup::where('key', '=', 'songs_folder')->first();
        if ($request->ajax()) {
            $idUser = $request->idUser;
            $searchString = '%'.$request->searchString.'%';
            $songs = DB::select("CALL searchSongs('".$request->searchBy . "','" . $searchString . "'," . $idUser.")");
            $page = Input::get('page', 1);  
            $paginate = 15;  
            $offSet = ($page * $paginate) - $paginate;  
            $itemsForCurrentPage = array_slice($songs, $offSet, $paginate, true);  
            $songs = new \Illuminate\Pagination\LengthAwarePaginator($itemsForCurrentPage, count($songs), $paginate, $page);

            // get user playlists
            if ($idUser > 0)
                $playlists = DB::table('playlists')->where('iduser', $idUser)->get();
            
            return view('partial.load')->withSongs($songs)
                ->with('songFolder', $setup)
                ->with('playlists', $playlists)
                ->with('msg', '-1')
                ->render();
        }
    }

    public function search2(){
        if (Auth::check()){
            $idUser = Auth::user()->id;
        }
        $searchBy = Input::get('searchBy');
        $searchString = Input::get('searchString');

        // check if request is empty or not; if empty, redirect to index
        $playlists = 0;
        $setup = Setup::where('key', '=', 'songs_folder')->first();
        $searchString = '%'.$searchString.'%';
        $query = "CALL searchSongs('".$searchBy . "','" . $searchString . "'," . $idUser.")";
        
        $songs = DB::select($query);
        $page = Input::get('page', 1);  
        $paginate = 15;
        $offSet = ($page * $paginate) - $paginate;
        $itemsForCurrentPage = array_slice($songs, $offSet, $paginate, true);
        $songs = new \Illuminate\Pagination\LengthAwarePaginator($itemsForCurrentPage, count($songs), $paginate, $page);

        // get user playlists
        if ($idUser > 0)
            $playlists = DB::table('playlists')->where('iduser', $idUser)->get();
            
        /*return view('index')->withSongs($songs)
            ->with('songFolder', $setup)
            ->with('playlists', $playlists)
            ->with('msg', '-1');*/

        return Response::json(array('response' => $songs));
            
    }
}