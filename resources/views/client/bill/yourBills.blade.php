@extends('layouts.client.app')
@section('content')

    <h4 class="text-center">
        الفواتير الجديدة التي تنتظر الدفع
    </h4>
    <h4 class="text-center">
        الفاتورة التي تريد ان تقوم بدفعها اضغط فقط على زر الدفع الذي بجانبها
    </h4>
    <h4 class="text-center">
         قم بدفع اكثر من واحدة عن طريق الضغط على السلة
    </h4>

    <div class="container">
        <div class="row">
            <div class="col-5 mt-5 text-center archivd">
                <h4 >
                    يمكنك الاطلاع على الفواتير المدفوعة من هنا
                </h4>
                @isset(request()->counter_number)
                <form action="{{route('archived.water')}}" method="get">
                    <input type="hidden" value="{{request()->counter_number}}" name="counter_number">
                    <input type="submit" class="btn btn-danger" value="الاطلاع">
                </form>
                @endisset()
                @isset(request()->hour_number)
                    <form action="{{route('archived.electricity')}}" method="get">
                        <input type="hidden" value="{{request()->hour_number}}" name="hour_number">
                        <input type="submit" class="btn btn-danger" value="الاطلاع">
                    </form>
                @endisset()
                @isset(request()->phone_number)
                    <form action="{{route('archived.telecome')}}" method="get">
                        <input type="hidden" value="{{request()->phone_number}}" name="phone_number">
                        <input type="submit" class="btn btn-danger" value="الاطلاع">
                    </form>
                @endisset()
            </div>
            <div class="d-flex flex-column aamt-5 col-7">

                @if($bills!='هذا الرقم غير موجود')
                @foreach($bills as $bill)
                    <div class="card con-bills" >
                        <div class="card-header text-center">
                            <table>
                                <tr>
                                    <td>رقم الدورة : </td>
                                    <td>{{$bill->course_number}}</td>
                                </tr>
                            </table>
                            </div>

                        <div class="card-body">
                            <table>
                                <tr>
                                    <td>الاسم : </td>
                                    <td>{{$bill->name}}</td>
                                </tr>
                                <tr>
                                    <td>تاريخ الاصدار : </td>
                                    <td>{{$bill->relase_date }}</td>
                                </tr>
                                <tr>
                                    <td>قيمة الفاتورة: </td>
                                    <td>{{$bill->amount_due_of_payment}}</td>
                                </tr>
                            </table>
                            <div class="mt-3">
                            @isset($bill->phone_number)
                            <a><button
                                    id="{{$bill->course_number}}"
                                    class="btn btn-outline-dark btn-add-basket"
                                    data-url="{{route('telecome.bill.payAll')}}"
                                    data-value="{{$bill->amount_due_of_payment}}"
                                    data-number="{{$bill->phone_number}}"
                                    data-course_number="{{$bill->course_number}}" >اضف الى السلة
                            </button></a>
                            <a href="{{route('telecome.bills.view',[$bill->phone_number,$bill->course_number])}}"><button class="btn btn-outline-primary">عرض</button></a>
                           <form class="d-inline" action="{{route('telecome.bill.pay',[$bill->phone_number,$bill->course_number,Auth::user()->bank_id])}}" method="post">
                               @csrf()
                               <input type="submit" class="btn btn-outline-success" value="ادفع"></input>
                           </form>
                            @endisset()

                            @isset($bill->hour_number)
                            <a><button
                                    id="{{$bill->course_number}}"
                                    class="btn btn-outline-dark btn-add-basket"
                                    data-url="{{route('electricity.bill.payAll')}}"
                                    data-value="{{$bill->amount_due_of_payment}}"
                                    data-number="{{$bill->hour_number}}"
                                    data-course_number="{{$bill->course_number}}" >اضف الى السلة
                            </button></a>
                            <a href="{{route('electricity.bills.view',[$bill->hour_number,$bill->course_number])}}"><button class="btn btn-outline-primary">عرض</button></a>
                            <form class="d-inline" action="{{route('electricity.bill.pay',[$bill->hour_number,$bill->course_number,Auth::user()->bank_id])}}" method="post">
                                @csrf()
                                <input type="submit" class="btn btn-outline-success" value="ادفع"></input>
                            </form>
                            @endisset()

                            @isset($bill->counter_number)
                            <a><button
                                    id="{{$bill->course_number}}"
                                    class="btn btn-outline-dark btn-add-basket"
                                    data-url="{{route('water.bill.payAll')}}"
                                    data-value="{{$bill->amount_due_of_payment}}"
                                    data-number="{{$bill->counter_number}}"
                                    data-course_number="{{$bill->course_number}}" >اضف الى السلة
                            </button></a>
                            <a href="{{route('water.bills.view',[$bill->counter_number,$bill->course_number])}}"><button class="btn btn-outline-primary">عرض</button></a>
                            <form class="d-inline" action="{{route('water.bill.pay',[$bill->counter_number,$bill->course_number,Auth::user()->bank_id])}}" method="post">
                                @csrf()
                                <input type="submit" class="btn btn-outline-success" value="ادفع"></input>
                            </form>
                            @endisset()
                            </div>
                        </div>
                    </div>
                    <br>
                @endforeach
                    @endif()

                @if($bills=='هذا الرقم غير موجود')
                        <div class="card con-bills mt-5" >
                            <div class="card-header text-center">
                                <h2>لا يوجد فواتير جديدة</h2>
                            </div>
                        </div>
                    @endif()
            </div>
        </div>
    </div>

@endsection
@push('style')
    <style>
        .archivd
        {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .con-bills
        {
            direction: rtl
        }
    </style>
    @endpush

