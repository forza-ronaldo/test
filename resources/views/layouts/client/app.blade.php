<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('css/client/style.css')}}">
    @stack('style')
    <style>
        .span-Basket
        {
            position:absolute !important;
            padding: 0px 4px;
            height: 20px;
            line-height: 121%;
            border-radius: 50% !important;
            left: 41px;
            top: -9px;
            display: none;
        }
        .one-span-Basket
        {

            left: 132px;
            top: -14px;
        }

        .fa.fa-shopping-cart
        {
            font-size: 28px;
        }
        .con-span-basket
        {
            position: relative;
        }
    </style>
    {{-- font awesome --}}
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand " href="home.html"><img src="{{asset('image/images/logo.svg')}}" width="50%"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ml-auto p-2">

            <li class="nav-item active">
                <a class="nav-link" href="{{route('home')}}">الصفحة الرئيسية </a>
            </li>


            @if( ! (Auth::user()->hasRole('admin')||Auth::user()->hasRole('super_admin')))
            <li class="nav-item">
                <a class="nav-link" href="{{route('Question.index')}}">الأسئلة الشائعة</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">من نحن</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">اتصل بنا</a>
            </li>
            @endif

            @if(Auth::user()->hasRole('admin')||Auth::user()->hasRole('super_admin'))
            <li class="nav-item">
                <a class="nav-link" href="{{route('dashboard.admin')}}">لوحة التحكم</a>
            </li>
            @endif


            <div class="btn-group">
                <span class="span-Basket one-span-Basket btn btn-danger"></span>

                <button type="button"  style="background: #163172;" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{Auth::user()->name}}
                </button>
                <div class="dropdown-menu" style="width: 10px;">
                    <a class="dropdown-item con-span-basket" href="{{route('home')}}"><i class="fa fa-shopping-cart"></i>  السلة
                        <span class="span-Basket btn btn-danger"></span>
                    </a>

                    <a class="dropdown-item" href="#">الرصيد الكلي : {{file_get_contents("http://localhost:777/bemoBank/public/api/getAccountInformation/".Auth::user()->bank_id)}}</a>
                    <a class="dropdown-item" href="/logout" > تسجيل خروج</a>
                </div>
            </div>

           {{-- <li class="nav-item dropdown">
                <a class="nav-link dropdo	wn-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{--  Auth::user()->name-
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#">الرصيد الكلي</a>
                    <a class="dropdown-item" href="#">تعديل</a>
                    <a class="dropdown-item" href="#">تسجيل الخروج</a>
                </div>
            </li>--}}
        </ul>
    </div>
</nav>
<div class="content">
    <div class="container">
        @if(session()->has('msg'))
            <div class="alert alert-warning">
                {{session()->get('msg')}}
            </div>
            @endif
    </div>
    @yield('content')
</div>
@stack('script')
<script>
    $(document).ready(function () {
        var countItemInBasket=0;
        $('.btn-add-basket').on('click',function () {
            if(!($(this).hasClass('Clicked'))){
                $(this).addClass('Clicked');
                countItemInBasket++;
                $(this).addClass('btn-secondary text-white').removeClass('btn-outline-secondary');
                $('.span-Basket').text(countItemInBasket);
                console.log(countItemInBasket)
            }
            else {
                $(this).removeClass('Clicked');
                countItemInBasket--;
                $(this).addClass('btn-outline-secondary').removeClass('btn-secondary text-white');
                $('.span-Basket').text(countItemInBasket);
                console.log(countItemInBasket)
                console.log($('.span-Basket').text())
            }
            $('.span-Basket').each(function () {
                if($(this).text()=='0'){
                    $(this).css('display','none');
                }
                else{
                    $(this).css('display','block');
                }
            })
        })
    })
</script>
</body>
</html>

