<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PlaylistDetail;
use App\Http\Requests;
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

    public function index(){;
        return Response::json(array('name' => 'Steve', 'state' => 'CA'));
    }
}
