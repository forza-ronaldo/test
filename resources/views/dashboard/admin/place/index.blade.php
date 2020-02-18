
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
                    <h3 class="mb-3 text-center">@lang('site.places') <small>{{ $places->total() }}</small></h3>
                    <div class="row">
                        <form class="row col-10" action="{{route('dashboard.place.index')}}">
                        <input class="form-control col-9" type="text" name="searsh"  placeholder="@lang('site.searsh')" value="{{ request()->searsh }}">
                        <button class=" btn-primary form-control col-2"><a>@lang('site.searsh')</a></button>
                        </form>

                         @if(auth()->user()->hasPermission('create_places'))
                          <a class="btn btn-primary form-control col-2 "  href="{{route('dashboard.place.create')}}"><i class="fa fa-plus"></i> @lang('site.add')</a>
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
                            <th scope="col">@lang('site.location')</th>
                            <th scope="col">@lang('site.center_type')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($places as $place)
                        <tr>
                            <th scope="row">{{$place->id}}</th>
                            <td>{{$place->name}}</td>
                            <td>{{$place->location}}</td>
                            <td>
                                @if ($place->center_type==0)
                                مياه
                                @elseif ($place->center_type==1)
                                كهرباء
                                @else
                                اتصالات
                                @endif
                            </td>
                            <td>


                                @if(auth()->user()->hasPermission('delete_places'))
                                <form class="d-inline" action="{{route('dashboard.place.destroy',$place->id)}}" method="post">
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
                    {{$places->appends(request()->query())->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
    @endsection


