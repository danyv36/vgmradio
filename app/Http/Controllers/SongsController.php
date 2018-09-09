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
use Session;

class SongsController extends Controller
{
    public function home(Request $request){
        $idUser = 0;
        $playlists = 0;
        $setup = Session::get('setup');
        $allSongs = Session::get('allSongs');
        if ($setup === NULL){
            $setup = Setup::where('key', '=', 'songs_folder')->first();
            Session::put('setup', $setup);
        }

        if (Auth::check()){
            $idUser = Auth::user()->id;
            JavaScript::put([
                'username' => Auth::user()->username,
                'idUser' => $idUser
            ]);
        }

        // for stored procedures, have to do pagination this way:
        // get likes for user if logged in
        // TODO: check if there has been an update where more songs were added
        if ($allSongs === NULL){
            $allSongs = DB::select('CALL getUserLikes('.$idUser.')');
            Session::put('allSongs', $allSongs);
        }
        $page = Input::get('page', 1);  
        $paginate = 15;  
        $offSet = ($page * $paginate) - $paginate;  
        $itemsForCurrentPage = array_slice($allSongs, $offSet, $paginate, true);  
        $songs = new \Illuminate\Pagination\LengthAwarePaginator($itemsForCurrentPage, count($allSongs), $paginate, $page);

        // get user playlists
        // TODO: only get user playlists if a change in playlists was detected
        if ($idUser > 0)
            $playlists = DB::table('playlists')->where('iduser', $idUser)->get();

        if ($request->ajax()) {
            $html = view('partial.load')->withSongs($songs)
                    ->with('songFolder', $setup)
                    ->with('playlists', $playlists)
                    ->with('msg', '-1')
                    ->render();

            $songsCount = count($songs);
            return Response::json(array('html' => $html, 'songsCount' => $songsCount));
        }
        return view('index')->withSongs($songs)
                ->with('songFolder', $setup)
                ->with('playlists', $playlists)
                ->with('msg', '-1');
        //return Response::json(array('setup'=> Session::get('setup'), 'session'=> $calledSession));
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
        $searchBy = Input::get('searchby');
        $searchString = Input::get('searchstring');

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
            
        return view('index')->withSongs($songs)
            ->with('songFolder', $setup)
            ->with('playlists', $playlists)
            ->with('msg', '-1');
            
    }
}