@extends('layouts.client.app')
@section('content')
    <section class="section overfree text-right">
        <div class="container">
            <h2>الشركة السورية للكهرباء</h2>
            <div class="row row-info text-right mt-5">
                <div class="col-lg-4 lable-info">
                    <label>{{$bill->hour_number}} :   رقم الساعة  </label><br>
                    <label>{{$bill->course_number}}:  رقم الدورة </label><br>
                    <label>{{$bill->relase_date}} : تاريخ الاصدار  </label><br>
                </div>
                <div class="col-lg-4"></div>
                <div class="col-lg-4 lable-info">
                    <label> {{$bill->next_relase_date}}:  تاريخ الاصدار القادم   </label><br>
                    <label> {{$bill->power}} : الطاقة </label><br>
                    <label> {{$bill->previous_visa}} : التأشيرة الحالية </label><br>
                    <label> {{$bill->current_visa}}  : التأشيرة القادمة</label><br>
                </div>
            </div>
            <div class="row row-table text-right mt-3">
                <div class="col-lg-12">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <td> {{$bill->amount_of_consumption}} : كمية الاستهلاك</td>
                            <td>  {{$bill->amount_due_of_payment}}: المبلغ المستحق الدفع</td>
                        </tr>
                        <tr>
                            <td> {{$bill->city}}: المدينة </td>
                            <td> {{$bill->area}} :  المنطقة </td>
                        </tr>
                        <tr>
                            <td><br></td>
                            <td> {{$bill->street}}: الشارع    </td>
                        </tr>
                        <tr>
                            <td> تاريخ الدفع :{{$bill->payment_date}}</td>
                            <td> رقم ايصال الدفع :{{$bill->receipt_id}}</td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="text-left">
                <a href="{{url()->previous()}}" class="btn btn-outline-dark">عودة</a>
            </div>
            <div class="mt-3 mb-3">
                <div class="card card-header-pills">
                    <div class="card-header-pills">
                        <h3>معلومات ايصال الدفع</h3>
                    </div>
                    <div class="card-body row receipt">
                        <div class="col" >
                            <table class=" w-100">

                                <tr>
                                    <td>{{$receipt->value}}</td>
                                    <td class="td-title">  : قيمة الفاتورة </td>
                                </tr>
                                <tr>
                                    <td>{{$receipt->relase_date}}</td>
                                    <td class="td-title">   : تاريخ الانشاء</td>
                                </tr>
                                <tr>
                                    <td>{{$receipt->bill_type}}</td>
                                    <td class="td-title">   : نوع الفاتورة</td>
                                </tr>
                            </table>

                        </div>
                        <div class="col ">
                            <table class=" w-100 ">
                                <tr>
                                    <td>{{$receipt->id}}</td>
                                    <td class="td-title"> : رقم الايصال</td>
                                </tr>
                                <tr>
                                    <td>{{$receipt->number}}</td>
                                    <td class="td-title"> : الرقم الخاص </td>
                                </tr>
                                <tr>
                                    <td>{{$receipt->course_number}}</td>

                                    <td class="td-title">  : رقم الدورة </td>
                                </tr>
                                <tr>
                                    <td>{{$receipt->name_payment}}</td>
                                    <td class="td-title">   :   اسم الدافع</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end container -->
    </section><!-- end section -->

@endsection()
