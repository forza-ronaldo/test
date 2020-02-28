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

    <nav class="navbar navbar-expand-lg navbar-light ">
        <a class="" href="#"><img src="{{asset('svg/new logo.svg')}}" width="170"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>


        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
             <li class="nav-item">
              <a class="nav-link" href="#">Conect as</a>
             </li>
             <li class="nav-item">
              <a class="nav-link "  href="{{ route('login') }}" >Login</a>
             </li>
             <li class="nav-item">
              <a class="nav-link " href="{{ route('register') }}">Register</a>
             </li>
          </ul>
          <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">language
            <span class="caret"></span></button>
            <ul class="dropdown-menu">
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <li>
                    <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                    {{ $properties['native'] }}
                    </a>
                </li>
            @endforeach
            </ul>
          </div>
        </div>
      </nav>

      <div class="container">
        <div class="row content">
            <h3 class="text-center w-75 worlds">نحن هنا من اجل تسهيل حياتكم يمكنك الان دفع فواتيرك اون لاين  </h3>
            <div class="col-lg-7 col-md-7 col-sm-12 mb-3 mt-5 position-relative " style="width: 18rem;">
              <form class="login position-absolute" id="login" action="{{ route('login') }}" method="post">
                @csrf()
                <div class="login-top"><h2 class="text-center">LOGIN</h2></div>
                  <div class="card-body  ">
                  <div>
                  <input class="form-control input mb-1" type="email" name="email" placeholder="Email" autocomplete="off">
                  <i class="fa fa-envelope-square" aria-hidden="true"></i>
                  @error('email')
                    <div class="alert alert-danger @error('email') is-invalid @enderror">{{$message}}</div>
                    @enderror
                  </div>
                  <div>
                  <input class="form-control input mb-1" type="password" name="password" placeholder="password" autocomplete="new-password">
                  <i class="fa fa-lock" aria-hidden="true"></i>
                  @error('password')
                    <div class="alert alert-danger @error('password') is-invalid @enderror">{{$message}}</div>
                    @enderror
                  </div>
                      <a href="{{route('showResetPasswordForm')}}">هل نسيت كلمة السر</a>
                  <input type="submit" value="Login" class="form-control mt-3 btn-submit" >
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



