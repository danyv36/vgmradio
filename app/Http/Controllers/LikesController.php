<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use App\Http\Requests;
use Response;

class LikesController extends Controller
{
    //
    public function store(Request $request){

        if ($request->ajax()) {
            $like = new Like;
            $like->idsong = $request->idSong;
            $like->iduser = $request->idUser;
            $like->likes = $request->likes;
            $data= $request->id;
            $like->save();
            return Response::json(array('status' => 1));
            //return $like;  
        }
    }

    public function index(){
        //return 'Hello! Get!';
        return Response::json(array('name' => 'Steve', 'state' => 'CA'));
        /*$like = new Like;
        $like->idsong = $request->idSong;
        $like->iduser = $request->idUser;
        $like->likes = $request->likes;*/
        //return $like;
    }
}
