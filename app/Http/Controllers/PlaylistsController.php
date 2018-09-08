<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlaylistRequest;
use App\Playlist;
use App\Setup;
use App\Song;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Input;
use JavaScript;
use Response;
use Redirect;

class PlaylistsController extends Controller
{
    public function store(PlaylistRequest $request)
    {
        if ($request->ajax()) {
            $playlist = new Playlist;
            $playlist->name = $request->name;
            $playlist->iduser = $request->idUser;
            $playlist->description = $request->description;
            $playlist->public = $request->public;
            $playlist->save();

            $idUser = $request->idUser;

            if ($idUser > 0) {
                $playlists = DB::table('playlists')->where('iduser', $idUser)->get();
            }

            $view = view('partial.playlists')->with('playlists', $playlists)->render();
            $viewinline = view('partial.playlistsinline')->with('playlists', $playlists)->render();
            return Response::json(array('html' => $view, 'htmlInline' => $viewinline));
        }
    }

    public function show(Request $request, $idPlaylist)
    {
        $idUser = 0;
        $setup = Setup::where('key', '=', 'songs_folder')->first();

        if (Auth::check()) {
            $idUser = Auth::user()->id;
            JavaScript::put([
                'username' => Auth::user()->username,
                'idUser' => $idUser,
                'idPlaylist' => $idPlaylist,
            ]);
        }

        // for stored procedures, have to do pagination this way:
        $songs = DB::select('CALL getPlaylistDetails(' . $idPlaylist . ',' . $idUser . ')');
        $page = Input::get('page', 1);
        $paginate = 15;
        $offSet = ($page * $paginate) - $paginate;
        $itemsForCurrentPage = array_slice($songs, $offSet, $paginate, true);
        $songs = new \Illuminate\Pagination\LengthAwarePaginator($itemsForCurrentPage, count($songs), $paginate, $page);

        // get user playlists
        if ($idUser > 0) {
            $playlists = DB::table('playlists')->where('iduser', $idUser)->get();
        }

        if ($request->ajax()) {
            $html = view('partial.load')->withSongs($songs)
                    ->with('songFolder', $setup)
                    ->with('playlists', $playlists)
                    ->with('msg', '-1')
                    ->render();

            $songsCount = count($songs);
            return Response::json(array('html' => $html, 'songsCount' => $songsCount));
        }
        
        return view('playlists/show')->withSongs($songs)
                ->with('songFolder', $setup)
                ->with('playlists', $playlists)
                ->with('msg', '-1')
                ;
    }

    public function update(Request $request)
    {
        if ($request->ajax()) {
            $playlist = Playlist::find($request->idPlaylist);
            $playlist->name = $request->name;
            $playlist->description = $request->description;
            $playlist->public = $request->public;
            $playlist->save();

            $idUser = $request->idUser;

            if ($idUser > 0) {
                $playlists = DB::table('playlists')->where('iduser', $idUser)->get();
            }
            $song = new Song;
            $song->playlistName = $playlist->name;
            $song->description = $playlist->description;
            $song->isPublic = $playlist->public;
            $song->idPlaylist = $request->idPlaylist;

            $songs = array($song);

            $view = view('partial.playlists')->with('playlists', $playlists)->render();
            $viewinline = view('partial.playlistsinline')->with('playlists', $playlists)->render();
            // to reload header and description in case they were updated:
            $viewheader = view('playlists.partial.header')->with('songs', $songs)->render();
            return Response::json(array('html' => $view, 'htmlInline' => $viewinline, 'htmlHeader' => $viewheader));
        }
    }

    public function destroy(Request $request, $playlist){
        /*if ($request->ajax()) {
            //$playlist = Playlist::find($request->idPlaylist);
            //$playlist->delete();

            return Redirect::route('home')->with('msg', 'Playlist successfully deleted');
        }*/
        try{
            $deletePlaylist = Playlist::find($playlist);
            $deletePlaylist->delete();
            $msg = 'Playlist successfully deleted';
            return Redirect::route('home')->with('msg', $msg);
        }
        catch(Exception $e){
            return Redirect::route('home')->with('msg', 'Sorry, something went wrong. Please try again.');
        }
    }
}
