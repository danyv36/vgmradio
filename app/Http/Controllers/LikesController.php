<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Like;
use App\Http\Requests;
use Response;

class LikesController extends Controller
{
    //
    public function store(Request $request){

        if ($request->ajax()) {
            $likeExists = DB::table('likes')->where([
                ['idsong', $request->idSong],
                ['iduser', $request->idUser]
            ])->get();

            $id = 0;
            $currentlyLikes = $request->likes;

            if (sizeof($likeExists) > 0 ){
                // if the like is already saved in DB
                $id = $likeExists[0]->id;
            }                

            // if $id > 0, and if currentlyLikes = -1, then delete like from DB
            // if $id > 0, and if currentlyLikes = 1 or 0, update like in DB
            // if $id = 0, and if currentlyLikes = 1 or 0, insert like in DB

            if ($id > 0){
                if ($currentlyLikes == -1){
                    DB::table('likes')->where('id', $id)->delete();
                }
                else{
                    DB::table('likes')->where('id', $id)->update(['likes'=>$currentlyLikes]);
                }
                return Response::json(array('status' => 1));
            }
            else{
                $like = new Like;
                $like->idsong = $request->idSong;
                $like->iduser = $request->idUser;
                $like->likes = $request->likes;
                $like->save();
                return Response::json(array('status' => 1));
            }
            //return $id;
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
