
@extends('layouts.dashboard.app')

@section('content')

@if(session()->has('success'))

    <div class="alert alert-info">{{session()->get('success')}}</div>
    @endif
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-3 text-center">@lang('site.admin') <small>{{ $users->total() }}</small></h3>
                    <div class="row">
                        <form class="row col-10" action="{{route('dashboard.user.index')}}">
                        <input class="form-control col-9" type="text" name="searsh"  placeholder="@lang('site.searsh')" value="{{ request()->searsh }}">
                        <button class=" btn-primary form-control col-2"><a>@lang('site.searsh')</a></button>
                        </form>

                         @if(auth()->user()->hasPermission('create_users'))
                          <a class="btn btn-primary form-control col-2 "  href="{{route('dashboard.user.create')}}"><i class="fa fa-plus"></i> @lang('site.add')</a>
                        @else
                         <a class="btn btn-primary form-control col-2 disabled"  href="#"><i class="fa fa-plus"></i> @lang('site.add')</a>
                        @endif

                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped text-center">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">@lang('site.name')</th>
                            <th scope="col">@lang('site.user_name')</th>
                            <th scope="col">@lang('site.email')</th>
                            <th scope="col">@lang('site.phone')</th>
                            <th scope="col">@lang('site.city')</th>
                            <th scope="col">@lang('site.created_at')</th>
                            <th scope="col">@lang('site.action')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($users as $user)
                        <tr>
                            <th scope="row">{{$user->id}}</th>
                            <td>{{$user->name}}</td>
                            <td>{{$user->user_name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone}}</td>
                            <td>{{$user->city}}</td>
                            <td>{{$user->created_at}}</td>
                            <td>
                                @if(auth()->user()->hasPermission('update_users'))
                                <li class="btn btn-sm btn-success">
                                    <a style="color: white" href={{route('dashboard.user.edit',$user->id)}}><i class="fa fa-edit" aria-hidden="true"></i> @lang('site.edit')</a>
                                </li>
                                @endif

                                @if(auth()->user()->hasPermission('delete_users'))
                                <form class="d-inline" action="{{route('dashboard.user.destroy',$user->id)}}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-sm btn-danger" onclick="confirm('are your sure')"><i class="fa fa-trash-o" aria-hidden="true"></i> @lang('site.delete')</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="8" class="text-center">empty.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                    {{$users->appends(request()->query())->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
    @endsection


