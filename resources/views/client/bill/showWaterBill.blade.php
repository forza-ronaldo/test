@extends('layouts.client.app')
@section('content')


    <section class="section overfree text-right">
        <div class="container">
            <h2> المؤسسة العامة للمياه </h2>
            <div class="row row-info text-right mt-5">
                <div class="col-lg-4 lable-info">
                    <label>{{$bill->counter_number}} : رقم العداد  </label><br>
                    <label>{{$bill->course_number}}: رقم الدورة </label><br>
                    <label>  الاسم : {{$bill->name}}  </label><br>
                </div>
                <div class="col-lg-4"></div>
                <div class="col-lg-4 lable-info">
                    <label> {{$bill->relase_date}}: تاريخ الاصدار  </label><br>
                    <label> {{$bill->next_relase_date}} : تاريخ الاصدار القادم </label><br>
                    <label> {{$bill->amount_of_consumption}} : كمية الاستهلاك  </label><br>
                    <label> {{$bill->amount_due_of_payment}}  : المبلغ المستحق الدفع </label><br>
                </div>
            </div>
            <div class="row row-table text-right mt-3">
                <div class="col-lg-12">
                    <table class="table table-bordered">
                        <tbody>

                        <tr>
                            <td>  المدينة : {{$bill->city}} </td>
                            <td>   المنطقة : {{$bill->area}} </td>
                        </tr>
                        <tr>
                            <td><br></td>
                            <td> الشارع : {{$bill->street}} </td>
                        </tr>


                        </tbody>
                    </table>
                </div>
            </div>
            <div class="text-left">
                <form class="d-inline" action="{{route('water.bill.pay',[$bill->counter_number,$bill->course_number,Auth::user()->bank_id])}}" method="post">
                    @csrf()
                    <input type="submit" class="btn btn-outline-success" value="ادفع"></input>
                </form>
                <a href="{{url()->previous()}}" class="btn btn-outline-primary ">عودة</a>
            </div>
        </div><!-- end container -->
    </section><!-- end section -->

@endsection()
