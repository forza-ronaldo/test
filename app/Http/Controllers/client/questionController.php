<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class questionController extends Controller
{

    public function  __construct()
    {

    }

    public function index()
    {
        $questions_water=question::where('status_view','=','1')->where('center_type','=','0')->get();
        $questions_electricity=question::where('status_view','=','1')->where('center_type','=','1')->get();
        $questions_telecome=question::where('status_view','=','1')->where('center_type','=','2')->get();
        return view('client.question.FAQ',compact('questions_water','questions_electricity','questions_telecome'));
    }//end index


    public function create()
    {
        return  view('client.question.newQestion');
    }//end create


    public function store(Request $request)
    {
        $request->validate([
            'center_type'=>'required|numeric',
            'text_question'=>'required|string|unique:questions,text_question'
        ]);

        $request_data = $request->all();
        $request_data['status_view'] = '0';
        $request_data['user_id'] = Auth::user()->id;
        question::create($request_data);
        session()->flash('success', __('site.msg_add'));
        return redirect(route('Question.index'));
    }//end store



}
