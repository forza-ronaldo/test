
@extends('layouts.dashboard.app')

@section('content')

@if(session()->has('success'))
    
    <div class="alert alert-info">{{session()->get('success')}}</div>
@endif

    <form class="mt-5" action="{{route('dashboard.question.store')}}" method="post">
        @csrf
        <div>
            <div>
            <label>text question</label>
            <textarea class="form-control input mb-1 @error('text_question') is-invalid @enderror"    name="text_question"  >{{ old('text_question') }}</textarea>
            </div>
            

            <div>
            <label>text answer</label>
            <textarea class="form-control input mb-1 @error('text_answer') is-invalid @enderror"   name="text_answer" > {{ old('text_answer') }}</textarea>
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

        <button class="form-control mt-2">@lang('site.add')</button>
    </form>
    @endsection
