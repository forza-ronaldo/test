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
                <a><button class="btn btn-danger">الاطلاع</button></a>
            </div>
            <div class="d-flex flex-column mt-5 col-7">
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
                            <a><button class="btn btn-outline-dark btn-add-basket">اضف الى السلة</button></a>
                            <a href="{{route('telecome.bills.view',[$bill->phone_number,$bill->course_number])}}"><button class="btn btn-outline-primary">عرض</button></a>
                           <form class="d-inline" action="{{route('telecome.bill.pay',[$bill->phone_number,$bill->course_number,Auth::user()->bank_id])}}" method="post">
                               @csrf()
                               <input type="submit" class="btn btn-outline-success" value="ادفع"></input>
                           </form>
                            @endisset()

                            @isset($bill->hour_number)
                            <a><button class="btn btn-outline-dark btn-add-basket">اضف الى السلة</button></a>
                            <a href="{{route('electricity.bills.view',[$bill->hour_number,$bill->course_number])}}"><button class="btn btn-outline-primary">عرض</button></a>
                            <form class="d-inline" action="{{route('electricity.bill.pay',[$bill->hour_number,$bill->course_number,Auth::user()->bank_id])}}" method="post">
                                @csrf()
                                <input type="submit" class="btn btn-outline-success" value="ادفع"></input>
                            </form>
                            @endisset()

                            @isset($bill->counter_number)
                            <a><button class="btn btn-outline-dark btn-add-basket">اضف الى السلة</button></a>
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
