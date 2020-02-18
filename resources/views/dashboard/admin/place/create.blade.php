
@extends('layouts.dashboard.app')

@section('content')

@if(session()->has('success'))

    <div class="alert alert-info">{{session()->get('success')}}</div>
@endif

    <form action="{{route('dashboard.place.store')}}" method="post" >
        @csrf
        <div>

            <div>
            <input class="form-control input mb-1 @error('name') is-invalid @enderror" value="{{ old('name') }}"  type="text" name="name"  placeholder="name" >
            </div>


            <div>
            <input class="form-control input mb-1 @error('location') is-invalid @enderror" value="{{ old('loaction') }}"  type="text" name="location" placeholder="location" autocomplete="off" >
            </div>

            <div>
            <input class="form-control input mb-1 @error('lat_lag') is-invalid @enderror" value="{{ old('lat_lag') }}"  type="text" name="lat_lag" placeholder="lat,lag" autocomplete="off" >
            </div>



            <label>center type</label>
            <div>
                <label class="radio-inline"><input type="radio"  value="0" name="center_type" >ماء</label>
                <label class="radio-inline"><input type="radio"  value="1" name="center_type">كهرباء </label>
                <label class="radio-inline"><input type="radio"  value="2" name="center_type">اتصالات </label>
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


