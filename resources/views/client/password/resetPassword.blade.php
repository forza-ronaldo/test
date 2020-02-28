<!DOCTYPE html>
<html lang="en" dir="{{LaravelLocalization::getCurrentLocaleDirection()}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>my bills</title>
    <link href="https://fonts.googleapis.com/css?family=Harmattan&display=swap" rel="stylesheet">
    {{-- URL::previous() --}}
    {{-- Styles --}}
    <style>
        .lore
        {
            cursor: pointer;
        }
    </style>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/auth/auth.css') }}" rel="stylesheet">
    {{-- font awesome --}}
    {{--     <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
     --}}
<!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>

    {{-- <script src='{{asset("js/auth/auth.js")}}'></script> --}}
</head>
<body>



<div class="container">

    <div class="row content">
        <div class="col-lg-7 col-md-7 col-sm-12 mb-3  position-relative " style="width: 18rem;">
            <form class="login position-absolute"  action="{{ route('searshYourAccount') }}" method="post">
                @csrf()
                <div class="login-top"><h2 class="text-center">Reset password</h2></div>
                <div class="card-body  ">
                    <div>
                        <input class="form-control input mb-1" type="email" name="email" placeholder="Email" autocomplete="off">
                        <i class="fa fa-envelope-square" aria-hidden="true"></i>
                        @error('email')
                        <div class="alert alert-danger @error('email') is-invalid @enderror">{{$message}}</div>
                        @enderror
                    </div>
                    @if(session()->has('sendEmailToResetPassword'))
                        <div class="alert alert-info">
                            {{session()->get('sendEmailToResetPassword')}}
                        </div>
                    @endif()
                    <input type="submit" value="searsh" class="form-control mt-3 btn-submit" >
                </div>
                <div class="login-bottom">  </div>
            </form>
        </div>
    </div>
</div>

<div class="text-center footer">
    <div class="container">
        Copyright @ 2020 fawateri
    </div>
</div>

</body>
</html>



