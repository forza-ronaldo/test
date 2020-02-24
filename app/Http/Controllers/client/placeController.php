<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\place;
use Illuminate\Http\Request;

class placeController extends Controller
{

    public function index()
    {
        $places_water=place::where('center_type','=','0')->get();
        $places_electricity=place::where('center_type','=','1')->get();
        $places_telecome=place::where('center_type','=','2')->get();
        return view('client.place.index',compact('places_water','places_electricity','places_telecome'));
    }//end index

    public function show(place $place)
    {
        return view('client.place.show',compact('place'));
    }

}
