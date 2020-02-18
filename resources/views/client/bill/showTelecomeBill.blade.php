@extends('layouts.client.app')
@section('content')


    <section class="section overfree text-right">
        <div class="container">
            <h2>الشركة السورية للاتصالات</h2>
            <div class="row row-info text-right mt-5">
                <div class="col-lg-4 lable-info">
                    <label>{{$bill->phone_number}} : رقم الهاتف  </label><br>
                    <label>{{$bill->course_number}}: رقم الدورة </label><br>
                    <label>{{$bill->name}} : الاسم  </label></label><br>
                </div>
                <div class="col-lg-4"></div>
                <div class="col-lg-4 lable-info">
                    <label> {{$bill->relase_date}}: تاريخ الاصدار  </label><br>
                    <label> {{$bill->next_relase_date}} : تاريخ الاصدار القادم </label><br>
                    <label> {{$bill->local_calls}} : الاتصالت المحلية </label><br>
                    <label> {{$bill->international_calls}}  : الاتصالات الدولية</label><br>
                </div>
            </div>
            <div class="row row-table text-right mt-3">
                <div class="col-lg-12">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <td> {{$bill->servise_adsl}} :  Asdl   </td>
                            <td>  {{$bill->amount_due_of_payment}}: قيمة الفاتورة   </td>
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

                <form class="d-inline" action="{{route('telecome.bill.pay',[$bill->phone_number,$bill->course_number,Auth::user()->bank_id])}}" method="post">
                    @csrf()
                    <input type="submit" class="btn btn-outline-success" value="ادفع"></input>
                </form>
                <a href="{{url()->previous()}}" class="btn btn-outline-dark">عودة</a>
            </div>

        </div><!-- end container -->
    </section><!-- end section -->

@endsection()
