
@extends('layouts.dashboard.app')

@section('content')

@if(session()->has('success'))

    <div class="alert alert-info">{{session()->get('success')}}</div>
@endif

    <form action="{{route('dashboard.user.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div>
            <div>
            <input class="form-control input mb-1 @error('bank_id') is-invalid @enderror" value="{{ old('bank_id') }}"  type="text" name="bank_id" placeholder="bank_id" >
            </div>


            <div>
            <input class="form-control input mb-1 @error('id_number') is-invalid @enderror" value="{{ old('id_number') }}"  type="text" name="id_number" placeholder="Id Number" >
            </div>


            <div>
            <input class="form-control input  mb-1 @error('user_name') is-invalid @enderror" value="{{ old('user_name') }}" type="text" name="user_name" placeholder="User Name" >
            </div>



            <div>
            <input class="form-control input mb-1 @error('name') is-invalid @enderror" value="{{ old('name') }}"  type="text" name="name"  placeholder="name" >
            </div>


            <div>
            <input class="form-control input mb-1 @error('email') is-invalid @enderror" value="{{ old('email') }}"  type="email" name="email" placeholder="Email" autocomplete="off" >
            </div>

            <div>
            <input class="form-control input mb-1 @error('password') is-invalid @enderror" value="{{ old('password') }}"  type="password" name="password" placeholder="Password" autocomplete="new-password" >
            </div>

            <div>
            <input class="form-control input mb-1 @error('password_confirmation') is-invalid @enderror" value="{{ old('password_confirmed') }}"  type="password" name="password_confirmation" placeholder="Re-Password" >
            </div>

            <div>
            <input class="form-control input mb-1 @error('phone') is-invalid @enderror" value="{{ old('phone') }}"  type="text" name="phone" placeholder="Phone" >
            </div>

            <div>
            <input class="form-control input mb-1 @error('city') is-invalid @enderror" value="{{ old('city') }}"  type="text" name="city" placeholder="City" >
            </div>

            <div class="">
                <label class="radio-inline"><input type="radio" value="0" name="gender" > male</label>
                <label class="radio-inline"><input type="radio"  value="1" name="gender">female </label>
            </div>
        <!--start permissions section-->
        <?php $models=['users','questions'];?>
        <?php $options=['create','read','update','delete','send'];?>
        <div class="row">
            <div class="col-md-12">
                <h5>@lang('site.permissions')</h5>
                <ul class="card">
                    @foreach($models as $index=>$model)
                        <li>
                            <a class='mr-2 '>{{$model}} </a>
                        </li>
                        <li>
                            @foreach($options as $option)
                            @if ($option=='send' && $model=='users')

                            @else
                            <label>@lang('site.'.$option)</label>
                            <input type="checkbox" name="permissions[]" value="{{$option}}_{{$model}}">
                            @endif
                            @endforeach
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- end permissions section-->
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
    @push('style')
    <style>

        .tabbable-panel {
            border:1px solid #eee;
            padding: 10px;
        }

        /* Default mode */
        .tabbable-line > .nav-tabs {
            border: none;
            margin: 0px;
        }
        .tabbable-line > .nav-tabs > li a.active {
            border-bottom: 3px solid red;
        }
        .tabbable-line > .nav-tabs > li {
            margin-right: 15px;
        }
        .tabbable-line > .nav-tabs > li > a {
            border: 0;
            margin-right: 0;
            color: #737373;
        }
        .tabbable-line > .nav-tabs > li > a > i {
            color: #a6a6a6;
        }

        .tabbable-line > .nav-tabs > li.open > a, .tabbable-line > .nav-tabs > li:hover > a {

            text-decoration: none;
        }
        .tabbable-line > .nav-tabs > li.open > a > i, .tabbable-line > .nav-tabs > li:hover > a > i {
            color: #a6a6a6;
        }
        .tabbable-line > .nav-tabs > li.open .dropdown-menu, .tabbable-line > .nav-tabs > li:hover .dropdown-menu {
            margin-top: 0px;
        }
        .tabbable-line > .nav-tabs > li.active {
            position: relative;
        }
        .tabbable-line > .nav-tabs > li.active > a {
        }
        .tabbable-line > .nav-tabs > li.active > a > i {
            color: #404040;
        }
        .tabbable-line > .tab-content {
            margin-top: -3px;
            background-color: #fff;
            border: 0;
            border-top: 1px solid #eee;
            padding: 15px 0;
        }
        .portlet .tabbable-line > .tab-content {
            padding-bottom: 0;
        }

        /* Below tabs mode */

        .tabbable-line.tabs-below > .nav-tabs > li {
            border-top: 4px solid transparent;
        }
        .tabbable-line.tabs-below > .nav-tabs > li > a {
            margin-top: 0;
        }
        .tabbable-line.tabs-below > .nav-tabs > li:hover {

        }
        .tabbable-line.tabs-below > .nav-tabs > li.active {
            margin-bottom: -2px;
            border-bottom: 0;
            border-top: 4px solid #f3565d;
        }
        .tabbable-line.tabs-below > .tab-content {
            margin-top: -10px;
            border-top: 0;
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
        }
    </style>


@endpush

