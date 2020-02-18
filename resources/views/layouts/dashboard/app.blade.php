<!DOCTYPE html>
<html lang="ar" dir="{{LaravelLocalization::getCurrentLocaleDirection()}}" >
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title')</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Style dashboard main -->
    <link href="{{ asset('css/dashboard/main.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!--jquey-->
    <script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
    <!--script question dashbord -->
    <script src="{{asset('js/dashboard/question.js')}}"></script>
    {{-- script main --}}
    <script src="{{asset('js/dashboard/main.js')}}"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    {{-- font awesome --}}



    {{-- custom style --}}
    @stack('style')


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
              <a class="nav-link" href="{{route('dashboard.admin')}}">الرئيسية</a>
             </li>

             <li class="nav-item">
              <a class="nav-link" href="{{route('dashboard.user.index')}}">المشرفين</a>
             </li>
             <li class="nav-item">
              <a class="nav-link" href="{{route('dashboard.place.index')}}">الاماكن</a>
             </li>
             <li class="nav-item">
              <a class="nav-link con-notifications" href="{{route('dashboard.question.index')}}">الاسئلة الشائعة
                <span class='span-notifications'>@isset($count_question_wait){{$count_question_wait}} @endisset</span>
              </a>

             </li>
             <li class="nav-item">
              <a class="nav-link" href="{{route('home')}}">ادفع الان</a>
             </li>

             <li class="nav-item">
              <a class="nav-link" href="logout" > تسجيل خروج</a>
            </li>

          </ul>
        </div>
      </nav>
      <div class="container">

            @yield('content')

      </div>
      @stack('script')
</body>
</html>
