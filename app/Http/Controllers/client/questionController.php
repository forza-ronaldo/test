<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Notifications\addNewQuestion;
use App\question;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class questionController extends Controller
{

    public function  __construct()
    {
    }

    public function index()
    {
        $questions_water = question::where('status_view', '=', '1')->where('center_type', '=', '0')->get();
        $questions_electricity = question::where('status_view', '=', '1')->where('center_type', '=', '1')->get();
        $questions_telecome = question::where('status_view', '=', '1')->where('center_type', '=', '2')->get();
        return view('client.question.FAQ', compact('questions_water', 'questions_electricity', 'questions_telecome'));
    } //end index


    public function create()
    {
        return  view('client.question.newQestion');
    } //end create
    public function store(Request $request)
    {
        $request->validate([
            'text_question' => 'required|string|unique:questions,text_question|max:255',
            'center_type' => 'required|numeric',
        ]);

        $request_data = $request->all();
        $request_data['status_view'] = '0';
        $request_data['user_id'] = Auth::user()->id;
        $question = question::create($request_data);
        $users = User::whereRoleIs('super_admin')->orWhereRoleIs('admin')->get();
        Notification::send($users, new addNewQuestion($question));
        session()->flash('success', __('site.msg_add'));
        return redirect(route('Question.index'));
    } //end store



}
