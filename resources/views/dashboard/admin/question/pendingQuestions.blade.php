
@extends('layouts.dashboard.app')

@section('content')

@if(session()->has('success'))
    <div class="alert alert-info">{{session()->get('success')}}</div>
    @endif

<div class="card">
                <div class="card-header">
                    <h3 class="mb-3 text-center">@lang('site.question') <small>{{ $questions->total() }}</small></h3>
                    <div class="row">
                        <form class="row col-10" action="{{route('dashboard.question.index')}}">
                        <input class="form-control col-6" type="text" name="searsh"  placeholder="@lang('site.searsh')" value="{{ request()->searsh }}">
                        <button class=" btn-primary form-control  col-2"><a>@lang('site.searsh')</a></button>
                        </form>



                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped text-center">
                        <thead>
                        <tr>
                            <th scope="col">@lang('site.id')</th>
                            <th scope="col">@lang('site.text_question')</th>
                            <th scope="col">@lang('site.text_answer')</th>
                            <th scope="col">@lang('site.action')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($questions as $question)
                        <tr>
                            <th scope="row">
                                 {{$question->id}}
                            </th>
                            <th scope="row">
                                <textarea  class="form-control" > {{$question->text_question}}</textarea>
                            </th>
                            <th scope="row">
                                <textarea  class="form-control" > {{$question->text_answer}}</textarea>
                            </th>
                            <td>

                            @if(auth()->user()->hasPermission('update_questions'))
                                <li class="btn btn-sm btn-success">
                                    <a style="color: white" href={{route('dashboard.question.edit',$question->id)}}><i class="fa fa-edit" aria-hidden="true"></i> @lang('site.edit')</a>
                                </li>
                            @endif
                            @if(auth()->user()->hasPermission('delete_questions'))
                                <form class="d-inline" action="{{route('dashboard.question.destroy',$question->id)}}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-sm btn-danger" ><i class="fa fa-trash-o" aria-hidden="true"></i> @lang('site.delete')</button>
                                </form>
                            @endif
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="8" class="text-center">empty.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                    {{$questions->appends(request()->query())->links()}}
                </div>
            </div>

@endsection
