@if(session()->has('msg'))
    <div class="alert alert-danger container" role="alert">
    {{ session()->get('msg') }}
    </div>
@endif
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
    <link href="{{ asset('/css/auth/auth.css') }}" rel="stylesheet">
    {{-- font awesome --}}
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>


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
              <a class="nav-link " href="{{ route('login') }}">Login</a>
             </li>
             <li class="nav-item">
              <a class="nav-link " href="{{ route('register') }}" >Register</a>
             </li>
          </ul>
        </div>
      </nav>

      <div class="container">
        <div class="row content">
            <h3 class="text-center w-75 worlds">نحن هنا من اجل تسهيل حياتكم يمكنك الان دفع فواتيرك اون لاين  </h3>
            <div class="col-lg-7 col-md-7 col-sm-12 mb-3 mt-5 position-relative " style="width: 18rem;">

              <form class="login position-absolute" id="register" action="{{ route('register') }}" method="post">
                @csrf()
                <div class="login-top"><h2 class="text-center">REGISTER</h2></div>
                  <div class="card-body">

                    <div>
                        <input class="form-control input mb-1 @error('bank_id') is-invalid @enderror" value="{{ old('bank_id') }}"  type="text" name="bank_id" placeholder="bank_id" >
                        <i class="fa fa-id-badge" aria-hidden="true"></i>

                    </div>
                    {{-- @error('bank_id')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror --}}

                    <div>
                        <input class="form-control input mb-1 @error('id_number') is-invalid @enderror" value="{{ old('id_number') }}"  type="text" name="id_number" placeholder="Id Number" >
                        <i class="fa fa-id-badge" aria-hidden="true"></i>

                    </div>
                    {{-- @error('id_number')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror --}}

                    <div>
                    <input class="form-control input  mb-1 @error('user_name') is-invalid @enderror" value="{{ old('user_name') }}" type="text" name="user_name" placeholder="User Name" >
                    <i class="fa fa-user" aria-hidden="true"></i>

                    </div>
                    {{-- @error('user_name')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror --}}


                    <div>
                    <input class="form-control input mb-1 @error('name') is-invalid @enderror" value="{{ old('name') }}"  type="text" name="name"  placeholder="name" >
                    <i class="fa fa-user" aria-hidden="true"></i>

                    </div>
                    {{-- @error('name')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror --}}

                    <div>
                    <input class="form-control input mb-1 @error('email') is-invalid @enderror" value="{{ old('email') }}"  type="email" name="email" placeholder="Email" autocomplete="off" >
                    <i class="fa fa-envelope-square" aria-hidden="true"></i>
                    {{--@error('email')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror--}}
                    </div>

                    <div>
                    <input class="form-control input mb-1 @error('password') is-invalid @enderror" value="{{ old('password') }}"  type="password" name="password" placeholder="Password" autocomplete="new-password" >
                    <i class="fa fa-lock" aria-hidden="true"></i>

                    </div>
                    {{--  @error('password')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror --}}

                    <div>
                    <input class="form-control input mb-1 @error('password_confirmation') is-invalid @enderror" value="{{ old('password_confirmed') }}"  type="password" name="password_confirmation" placeholder="Re-Password" >
                    <i class="fa fa-lock" aria-hidden="true"></i>
                    {{--@error('password_confirmation')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror--}}
                    </div>

                    <div>
                    <input class="form-control input mb-1 @error('phone') is-invalid @enderror" value="{{ old('phone') }}"  type="text" name="phone" placeholder="Phone" >
                    <i class="fa fa-phone" aria-hidden="true"></i>
                    {{--@error('phone')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror--}}
                    </div>

                    <div>
                    <input class="form-control input mb-1 @error('city') is-invalid @enderror" value="{{ old('city') }}"  type="text" name="city" placeholder="City" >
                    <i class="fa fa-location-arrow" aria-hidden="true"></i>

                    </div>
                    {{-- @error('city')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror --}}

                    <div class="text-center">
                        <label class="radio-inline"><input type="radio" value="0" name="gender" > male</label>
                        <label class="radio-inline"><input type="radio"  value="1" name="gender">female </label>
                    {{--@error('gender')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror--}}
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
                    <input type="submit" value="Register" class="form-control mt-3 btn-submit" >

                    <div class="login-bottom"></div>
                </div>
              </form>


          </div>
        </div>
      </div>

      <div class=" footer">
        <div class="container">
          Copyright &copy;2020 my bills
          </div>
      </div>

</body>
</html>
