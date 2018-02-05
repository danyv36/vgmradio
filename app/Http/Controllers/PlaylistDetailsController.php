<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PlaylistDetail;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Response;

class PlaylistDetailsController extends Controller
{
    public function store(Request $request){
        if ($request->ajax()) {
            $playlistDetail = new PlaylistDetail;
            $playlistDetail->idsong = $request->idSong;
            $playlistDetail->idplaylist = $request->idPlaylist;
            $playlistDetail->save();
            return Response::json(array('status' => 1));
        }
    }

    public function destroy(Request $request){
        if ($request->ajax()){
            $idsong = $request->idSong;
            $idplaylist = $request->idPlaylist;

            if ($idsong != null && $idplaylist != null){
                /*$playlistDetail = PlaylistDetail::where([
                    ['idsong', '=',$idsong],
                    ['idplaylist', '=', $idplaylist]
                ])->get();*/
                DB::table('playlist_details')->where([
                    ['idsong', '=',$idsong],
                    ['idplaylist', '=', $idplaylist]
                ])->delete();
                return Response::json(array('status' => 1));
            }
            else{
                return Response::json(array('status' => 0));
            }
        }
    }

    public function index(){
        return Response::json(array('name' => 'Steve', 'state' => 'CA'));
    }
}
