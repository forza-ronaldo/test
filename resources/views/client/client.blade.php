@extends('layouts/client/app')
@section('content')
    <section class="section overfree">
        <div class="container">
            <div class="section-title text-center">
                <small>اهلا بكم في موقعنا</small>
                <h3>لدفع الفواتير من المنزل او اي مكان أخر</h3>

                <p class="lead"> من خلالنا يمكنك دفع فواتير منزلك من دون الذهاب الى المركز الرسمية <br>فاتورة مياه و فاتورة كهرباء و فاتورة هاتف</p>
            </div><!-- end section-title -->

            <div class="row service-list text-center">
                <div class="col-md-4 col-sm-12 col-xs-12 first">
                    <div class="service-wrapper wow fadeIn">
                        <img src="{{asset('image/images/idea.svg')}}" style="width: 19%;">
                        <div class="service-details">
                            <h4>فاتورة الكهرباء</h4>

                            <form action="{{route('new.electricity')}}" method="get">
                                <input type="text" name="hour_number" class="form-control @error('hour_number') is-invalid @enderror" placeholder="رقم الساعة">
                                @error('hour_number')
                                <div class="alert-danger">{{$message}}</div>
                                @enderror
                                <button type="submit" class="readmore">بحث</button>

                            </form>
                        </div>
                    </div><!-- end service-wrapper -->
                </div><!-- end col -->

                <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="service-wrapper wow fadeIn">
                        <img src=" {{asset('image/images/tap.svg')}} " style="width: 20%;">
                        <div class="service-details">
                            <h4>فاتورة الماء</h4>
                            <form action="{{route('new.water')}}" method="get">
                                <input type="text" name="counter_number" class="form-control @error('counter_number') is-invalid @enderror" placeholder="رقم العداد">
                                @error('counter_number')
                                <div class="alert-danger">{{$message}}</div>
                                @enderror
                                <button type="submit" class="readmore">بحث</button>
                            </form>
                        </div>
                    </div><!-- end service-wrapper -->
                </div><!-- end col -->

                <div class="col-md-4 col-sm-12 col-xs-12 last">
                    <div class="service-wrapper wow fadeIn">
                        <img src=" {{asset('image/images/old-typical-phone.svg')}} " style="width: 23%;">
                        <div class="service-details">
                            <h4>فاتورة هاتف</h4>
                            <form action="{{route('new.telecome')}}" method="get">
                                <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" placeholder="رقم الهاتف">
                                @error('phone_number')
                                <div class="alert-danger">{{$message}}</div>
                                @enderror
                                <button type="submit" class="readmore">بحث</button>
                            </form>
                        </div>
                    </div><!-- end service-wrapper -->
                </div><!-- end col -->
            </div><!-- end row -->



            <div class="row">
                <div class="col-md-6">
                    <div class="milestone-counter c1">
                        <img src="{{asset('image/images/icon_07.png')}}" alt="" class="alignleft">
                        <h3 class="stat-count">{{$users}}</h3>
                        <p>العملاء</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="milestone-counter c2">
                        <img src="{{asset('image/images/icon_08.png')}}" alt="" class="alignleft">
                        <h3 class="stat-count">{{$count_total}}</h3>
                        <p>مرات الاستخدام</p>
                    </div>
                </div>

            </div>
        </div><!-- end container -->
    </section><!-- end section -->



    <section class="container text-center">

        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">تطبيق الهاتف النقال</div>
                    <div class="panel-body">
                        <h3>قم بتحميل تطبيقنا للهاتف النقال</h3>
                        <p>
                            قم بتحميل تطبيق (خدمة) للهاتف النقال
                            إعادة شحن خدمات مسبقة الدفع
                            إطلع وادفع جميع الفواتير
                            (الكهرباء ، المياه ، الاتصالات)</p>
                        <img src="{{asset('image/images/play-store.png')}}">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">إعلانات</div>
                    <div class="panel-body"><h3>"مركز اتصالات "خدمة"</h3>
                        <p>	يعمل يوميا من ٨ صباحا الى ٨ مساء من الاحد الى الخميس ومن ٨ صباحا الى ٤ العصر يومي الجمعة والسبت</p>
                    </div>
                </div>
            </div>


        </div>
    </section>
    @endsection


