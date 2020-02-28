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
    <script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!--jquey-->
    <script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
    <!--script question  dashbord -->
    <script src="{{asset('js/dashboard/question.js')}}"></script>
    {{-- script main --}}
    <script src="{{asset('js/dashboard/main.js')}}"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    {{-- font awesome --}}
    {{-- font awesome --}}
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">


    {{-- custom style --}}
<style>
    .con-noti
    {
        padding: 0px;
    }
    .li-noti hr
    {
        margin: 5px 0px 0px 0px;
    }
    .li-noti:hover
    {
        background:#eee;
    }
    .li-noti a:hover
    {
        text-decoration: none;
        color:#253570;
    }
    .li-noti a
    {
        color:#6b6060;
    }
</style>
    @stack('style')


</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light ">
        <a class="" href="#"><img src="{{asset('svg/new logo.svg')}}" width="170"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>


        </button>
        <div  class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <div class="btn-group">
                    <button type="button" style="background: #163172;"  class="con-span-noti-count btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-bell-o"></i>
                        <span class="span-noti-count {{ count(auth()->user()->unreadNotifications)!=0?'':'d-none' }}">{{count(auth()->user()->unreadNotifications)}}</span>
                    </button>
                    <div  class="dropdown-menu con-noti" style="width: 400px;height: 318px;overflow-y: scroll;word-break: break-word;">
                        <ul class="list-unstyled ">
                            @foreach(auth()->user()->Notifications as $noti)
                                <li class="li-noti {{$noti->read_at==null?'bg-danger':''}}">
                                    {!!$noti->data['data']['text_question']!!}
                                    {{ $noti->markAsRead() }}
                                    <hr/>
                                </li>
                                @endforeach()
                        </ul>
                    </div>
                </div>
                <li class="nav-item">
                    <a class="nav-link" >
                    </a>
                </li>
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
