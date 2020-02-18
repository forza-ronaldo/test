
@extends('layouts.dashboard.app')

@section('content')

@if(session()->has('success'))

    <div class="alert alert-info">{{session()->get('success')}}</div>
@endif

    <form class="mt-5" action="{{route('dashboard.question.update',$question->id)}}" method="post">
        @csrf
        @method("PUT")
        <div>
            <div>

            <label>text question</label>
            <textarea class="form-control input mb-1 @error('text_question') is-invalid @enderror"    name="text_question"  >{{ $question->text_question }}</textarea>
            </div>


            <div>
            <label>text answer</label>
            <textarea class="form-control input mb-1 @error('text_answer') is-invalid @enderror"   name="text_answer" > {{  $question->text_answer }}</textarea>
            </div>

            <div>
            <label>status view</label><br>
            <input type="radio"  {{$question->status_view==2?'checked':''}} value="2"  name="status_view" >اخفاء
           <br> <input type="radio"  {{$question->status_view==1?'checked':''}} value="1"  name="status_view" >اظهار
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        <button class="form-control mt-2">@lang('site.edit')</button>
    </form>
    @endsection
