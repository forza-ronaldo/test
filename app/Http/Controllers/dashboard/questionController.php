<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class questionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:create_questions')->only('create');
        $this->middleware('permission:read_questions')->only('index');
        $this->middleware('permission:update_questions')->only('edit');
        $this->middleware('permission:delete_questions')->only('destroy');
        $this->middleware('permission:send_questions')->only('questionAwaitingTheAnswer');
    }

    public function index(Request $request)
    {
        $questions = question::where('status_view', 1)->when($request->searsh, function ($query) use ($request) {
            return $query->where('text_question', 'like', '%' . $request->searsh . '%');
        })->paginate(5);
        $count_question_wait = question::where('status_view', 0)->count();

        return view('dashboard.admin.question.index', compact('questions','count_question_wait'));
    } //end index


    public function create()
    {
        return view('dashboard.admin.question.create');
    } //end create


    public function store(Request $request)
    {

        $request->validate([
            'text_question' => 'required|unique:questions|max:255',
            'text_answer' => 'required|max:255',
        ]);
        $request_data = $request->all();
        $request_data['status_view'] = '1';
        $request_data['user_id'] = Auth::user()->id;
        question::create($request_data);
        session()->flash('success', __('site.msg_add'));
        return redirect(route('dashboard.question.index'));
    } //end store

    public function edit(question $question)
    {
        return view('dashboard.admin.question.edit', compact('question'));
    } //end edit


    public function update(Request $request, question $question)
    {
        $request->validate([
            'text_question' => 'required|max:255|' . Rule::unique('questions')->ignore($question->text_question, 'text_question'),
            'text_answer' => 'required|max:255',
        ]);
        $request_data = $request->all();
        $request_data['user_id'] = '1';
        $question->update($request_data);
        session()->flash('success', __('site.msg_edit'));
        return redirect(route('dashboard.question.index'));
    } //end update

    public function destroy(question $question)
    {
        $question->delete();
        session()->flash('success', __('site.msg_delete'));
        return redirect(route('dashboard.question.index'));
    } //end destory
    public function questionAwaitingTheAnswer()
    {
        $questions = question::where('status_view', 0)->paginate(3);
        $count_question_wait = question::where('status_view', 0)->count();

        return view('dashboard.admin.question.questionAwaitingTheAnswer', compact('questions','count_question_wait'));
    } //end questionAwaitingTheAnswer

    public function sendReply(Request $request, question $question)
    {
        $question->update(
            [
                'text_answer' => $request->text_answer,
                'status_view' => '2'
            ]
        );

        $details = [
            // 'title' => $request->title,
            'body' => $request->text_answer,
        ];
        \Mail::to($question->User->email)->send(new \App\Mail\sendAnswer($details));
        return redirect()->route('dashboard.questionAwaitingTheAnswer');
    } //end send reply

    public function pendingQuestions(Request $request)
    {
        $questions = question::where('status_view', 2)->when($request->searsh, function ($query) use ($request) {
            return $query->where('text_question', 'like', '%' . $request->searsh . '%');
        })->paginate(5);
        return view('dashboard.admin.question.pendingQuestions', compact('questions'));
    } //end pending
    public function show($id)
    {
        # code...
    }
}//end questionController
