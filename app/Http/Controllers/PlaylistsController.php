<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Setup;
use App\Song;
use App\Http\Requests;
use App\Http\Requests\PlaylistRequest;
use App\Playlist;

use Auth;
use JavaScript;
use Input;
use Response;

class PlaylistsController extends Controller
{
    public function store(PlaylistRequest $request){
        if ($request->ajax()) {
            $playlist = new Playlist;
            $playlist->name = $request->name;
            $playlist->iduser = $request->idUser;
            $playlist->description = $request->description;
            $playlist->public = $request->isPublic;
            $playlist->save();

            $idUser = $request -> idUser;
            
            if ($idUser > 0)
                $playlists = DB::table('playlists')->where('iduser', $idUser)->get();
            //return view('partial.playlists')->with('playlists', $playlists)->render();

            $view = view('partial.playlists')->with('playlists', $playlists)->render();
            $viewinline = view('partial.playlistsinline')->with('playlists', $playlists)->render();
            return Response::json(array('html' => $view, 'htmlInline' => $viewinline));
        }
    }

    public function show(Request $request, $idPlaylist){
        $idUser = 0;
        $setup = Setup::where('key', '=', 'songs_folder')->first();
        //$songs = DB::table('songs')->paginate(15); // get songs only

        if (Auth::check()){
            $idUser = Auth::user()->id;
            JavaScript::put([
                'username' => Auth::user()->username,
                'idUser' => $idUser,
                'idPlaylist' => $idPlaylist
            ]);
        }

        // for stored procedures, have to do pagination this way:
        $songs = DB::select('CALL getPlaylistDetails('.$idPlaylist.','.$idUser.')');
        $page = Input::get('page', 1);
        $paginate = 15;
        $offSet = ($page * $paginate) - $paginate;  
        $itemsForCurrentPage = array_slice($songs, $offSet, $paginate, true);  
        $songs = new \Illuminate\Pagination\LengthAwarePaginator($itemsForCurrentPage, count($songs), $paginate, $page);

        // get user playlists
        if ($idUser > 0)
            $playlists = DB::table('playlists')->where('iduser', $idUser)->get();

        if ($request->ajax()) {
            return view('playlists/songlist')->withSongs($songs)->with('songFolder', $setup)->with('playlists', $playlists)->render();
        }
        return view('playlists/show')->withSongs($songs)->with('songFolder', $setup)->with('playlists', $playlists);
    }

    public function update(Request $request){
        
    }
}
