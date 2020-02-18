@extends('layouts.client.app')
@section('content')


    <section class="section overfree text-right">
        <div class="container">
            <h2>الشركة السورية للكهرباء</h2>
            <div class="row row-info text-right mt-5">
                <div class="col-lg-4 lable-info">
                    <label>{{$bill->hour_number}} :   رقم الساعة  </label><br>
                    <label>{{$bill->course_number}}:  رقم الدورة </label><br>
                    <label>{{$bill->relase_date}} : تاريخ الاصدار  </label></label><br>
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


                        </tbody>
                    </table>
                </div>
            </div>
            <div class="text-left">
                <form class="d-inline" action="{{route('electricity.bill.pay',[$bill->hour_number,$bill->course_number,Auth::user()->bank_id])}}" method="post">
                    @csrf()
                    <input type="submit" class="btn btn-outline-success" value="ادفع"></input>
                </form>
                <a href="{{url()->previous()}}" class="btn btn-outline-success">عودة</a>

            </div>
        </div><!-- end container -->
    </section><!-- end section -->

@endsection()
