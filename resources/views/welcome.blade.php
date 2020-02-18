<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>my bills</title>
<link href="https://fonts.googleapis.com/css?family=Harmattan&display=swap" rel="stylesheet">

    {{-- Styles --}}
    <style>
     .lore
     {
       cursor: pointer;
     }
    </style>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('../resources/css/auth/auth.css') }}" rel="stylesheet">
    {{-- font awesome --}}
    <link href="{{ asset('../resources/css/font-awesome.min.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{asset('../resources/js/jquery-3.4.1.min.js')}}"></script>
    <script src='{{asset("../resources/js/auth/auth.js")}}'></script>

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
              <a class="nav-link lore"  data-target="login" >Login</a>
             </li>
             <li class="nav-item">
              <a class="nav-link lore"  data-target="register">Register</a>
             </li>
          </ul>
        </div>
      </nav>

      <div class="container">
        <div class="row content">
            <h3 class="text-center w-75 worlds">نحن هنا من اجل تسهيل حياتكم يمكنك الان دفع فواتيرك اون لاين  </h3>
            <div class="col-lg-7 col-md-7 col-sm-12 mb-3 mt-5 position-relative " style="width: 18rem;">

              <form class="login position-absolute" id="register" action="{{route('lore.register')}}" method="post">
                @csrf()
                <div class="login-top"><h2 class="text-center">REGISTER</h2></div>
                  <div class="card-body">
                    <div>
                    <input class="form-control input  mb-1 @error('username') is-invalid @enderror" value="{{ old('username') }}" type="text" name="username" placeholder="User Name" autocomplete="off">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    @error('username')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    </div>

                    <div>
                    <input class="form-control input mb-1 @error('phone') is-invalid @enderror" value="{{ old('naphonema') }}"  type="text" name="phone" placeholder="Phone" >
                    <i class="fa fa-phone" aria-hidden="true"></i>
                    @error('name')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    </div>

                    <div>
                    <input class="form-control input mb-1 @error('city') is-invalid @enderror" value="{{ old('city') }}"  type="text" name="city" placeholder="City" >
                    <i class="fa fa-location-arrow" aria-hidden="true"></i>
                    @error('name')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    </div>

                    <div>
                    <input class="form-control input mb-1 @error('id_number') is-invalid @enderror" value="{{ old('id_number') }}"  type="text" name="id_number" placeholder="Id Number" >
                    <i class="fa fa-id-badge" aria-hidden="true"></i>
                    @error('name')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    </div>

                    <div>
                    <input class="form-control input mb-1 @error('id_card') is-invalid @enderror" value="{{ old('id_card') }}"  type="text" name="id_card" placeholder="Id Card" >
                    <i class="fa fa-id-badge" aria-hidden="true"></i>
                    @error('name')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    </div>

                    <div>
                    <input class="form-control input mb-1 @error('full_name') is-invalid @enderror" value="{{ old('full_name') }}"  type="text" name="full_name" placeholder="Full Name" >
                    <i class="fa fa-user" aria-hidden="true"></i>
                    @error('name')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    </div>

                    <div>
                    <input class="form-control input mb-1 @error('email') is-invalid @enderror" value="{{ old('email') }}"  type="email" name="email" placeholder="Email" autocomplete="off" >
                    <i class="fa fa-envelope-square" aria-hidden="true"></i>
                    @error('name')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    </div>

                    <div>
                    <input class="form-control input mb-1 @error('password') is-invalid @enderror"   type="password" name="password" placeholder="Password" autocomplete="new-password" >
                    <i class="fa fa-lock" aria-hidden="true"></i>
                    @error('name')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    </div>

                    <div>
                    <input class="form-control input mb-1 @error('re_password') is-invalid @enderror"   type="password" name="re_password" placeholder="Re-Password" >
                    <i class="fa fa-lock" aria-hidden="true"></i>
                    @error('name')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    </div>

                    <input type="submit" value="Register" class="form-control mt-3 btn-submit" >

                    <div class="login-bottom">  </div>
                </div>
              </form>

              <form class="login position-absolute" id="login" action="{{ route('lore.login') }}" method="post">
                @csrf()
                <div class="login-top"><h2 class="text-center">LOGIN</h2></div>
                  <div class="card-body  ">
                  <div>
                  <input class="form-control input mb-1" type="email" name="email_login" placeholder="Email" autocomplete="off">
                  <i class="fa fa-envelope-square" aria-hidden="true"></i>
                  @error('email_login')
                    <div class="alert alert-danger @error('email_login') is-invalid @enderror">{{$message}}</div>
                    @enderror
                  </div>
                  <div>
                  <input class="form-control input mb-1" type="password" name="password_login" placeholder="password" autocomplete="new-password">
                  <i class="fa fa-lock" aria-hidden="true"></i>
                  @error('password_login')
                    <div class="alert alert-danger @error('password_login') is-invalid @enderror">{{$message}}</div>
                    @enderror
                  </div>
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



