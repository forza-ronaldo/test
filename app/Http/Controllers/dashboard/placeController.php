<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\place;
use Illuminate\Http\Request;

class placeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $places = place::when($request->searsh, function ($q) use ($request) {

            return $q->where('location', 'like', '%' . $request->searsh . '%');
        })->paginate(5);
        return view('dashboard.admin.place.index', compact('places'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.admin.place.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string',
            'location'    => 'required|string',
            'lat_lag'     => 'required|string',
            'center_type' => 'required|numeric',

        ]);
        place::create($request->all());
        session()->flash('success', __('site.msg_add'));
        return redirect(route('dashboard.place.index'));
    } //end index

    public function destroy(place $place)
    {
        $place->delete();
        session()->flash('success', __('site.msg_delete'));
        return redirect(route('dashboard.place.index'));
    } // end destroy
}
