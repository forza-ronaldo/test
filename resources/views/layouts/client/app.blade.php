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
    <script src="{{asset('js/main.js')}}"></script>
    <script src="{{asset('js/plugins/morris/morris.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="{{asset('js/plugins/morris/morris.css') }}" rel="stylesheet">

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
                <a class="nav-link" href="{{route('places.index')}}">الاماكن</a>
            </li>
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

                <button type="button"  style="background: #163172;"  class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{Auth::user()->name}}
                </button>
                <div class="dropdown-menu" style="width: 10px;">
                    <a type="button" class="dropdown-item con-span-basket"
                       data-target=".bd-example-modal-lg"
                       data-toggle="modal"
                       href="{{route('home')}}"><i class="fa fa-shopping-cart"></i>  السلة
                        <span class="span-Basket btn btn-danger"></span>
                    </a>
                    <a class="dropdown-item" href="{{route('Client.edit',auth()->id())}}" >تغير اعدادات الحساب </a>
                    <a class="dropdown-item" href="#">الرصيد الكلي : {{file_get_contents("http://localhost:777/bemoBank/public/api/getAccountInformation/".Auth::user()->bank_id)}}</a>
                    <a class="dropdown-item" href="/logout" > تسجيل خروج</a>
                </div>
            </div>
        </ul>
    </div>
</nav>
<div class="content">
    <div class="container">

             @if(session()->has('all_msg_results_pay'))
                @foreach(session()->get('all_msg_results_pay') as $s)
                    <div class="alert alert-warning text-center">
                         {{$s}}
                    </div>
                @endforeach()
             @else
                @if(session()->has('msg'))
                <div class="alert alert-warning text-center">
                    {{session()->get('msg')}}
                </div>
                @endif
             @endif

    </div>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">السلة</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-pay-all" method="post" class="d-inline">
                    @csrf()
                <table id="table-bill" class="table tab-content">
                    <thead>
                    <tr>
                        <th>رقم الخاص</th>
                        <th>رقم الدورة </th>
                        <th>القيمة</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">اغلاق</button>
                    <input type="submit" class="btn btn-outline-success btn-pay-all d-none" value="ادفع">
                </div>
                </form>


            </div>
        </div>
    </div>
    @yield('content')
</div>
@stack('script')

</body>
</html>

