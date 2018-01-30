<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PlaylistDetails;
use App\Http\Requests;
use Response;

class PlaylistDetailsController extends Controller
{
    public function store(Request $request){
        if ($request->ajax()) {
        }
    }
}
