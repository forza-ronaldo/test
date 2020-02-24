@extends('layouts.client.app')
@section('content')

    <div class="container">
        <div class="container mt-3 card">
            <div class="card-header-pills text-center">
                <h4>  معدل الاستهلاك في كل دورة</h4>
            </div>
            <div class="card-body">
                <div class="box-body border-radius-none">
                    <div class="chart" id="line-chart" style="height: 250px;"></div>
                </div>
            </div>
        </div>
            <div class="mt-5">
                <div class="card con-bills" >
                    <div class="card-header text-center">
                        <h4 class="text-center">الفواتير المؤرشفة</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <tr>
                                <td>الاسم</td>
                                <td>رقم الخاص </td>
                                <td>رقم الدورة </td>
                                <td>تاريخ الاصدار</td>
                                <td>تاريخ الدفع</td>
                                <td>قيمة الفاتورة</td>
                                <td>خيارات</td>
                            </tr>
                            @if($bills!='هذا الرقم غير موجود')
                            @foreach($bills as $bill)
                            <tr>
                                <td>{{$bill->name}}</td>
                                <td>
                                    @isset($bill->phone_number){{$bill->phone_number}} @endisset
                                    @isset($bill->hour_number){{$bill->hour_number}} @endisset
                                    @isset($bill->counter_number){{$bill->counter_number}} @endisset
                                </td>
                                <td>{{$bill->course_number}}</td>
                                <td>{{$bill->relase_date }}</td>
                                <td>{{$bill->payment_date}}</td>
                                <td>{{$bill->amount_due_of_payment}}</td>
                                @isset($bill->phone_number)
                                   <td> <a href="{{route('archived.telecome.bills.view',[$bill->phone_number,$bill->course_number])}}"><button class="btn btn-outline-primary">عرض</button></a></td>
                                @endisset()
                                @isset($bill->hour_number)
                                   <td><a href="{{route('archived.electricity.bills.view',[$bill->hour_number,$bill->course_number])}}"><button class="btn btn-outline-primary">عرض</button></a></td>
                                @endisset()
                                @isset($bill->counter_number)
                                   <td><a href="{{route('archived.water.bills.view',[$bill->counter_number,$bill->course_number])}}"><button class="btn btn-outline-primary">عرض</button></a></td>
                                @endisset()
                            </tr>
                            @endforeach
                            @endif()
                        </table>
                    </div>
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
@push('script')
    <script>

        var line = new Morris.Line({
            element: 'line-chart',
            resize: true,
            data: [
                    @if($code =='200')
                    @foreach ($statistic as $data)
                {
                    ym: "{{$data->relase_date }}", sum: "{{$data->amount_due_of_payment }}"
                },
                @endforeach
                @endif()
            ],
            xkey: 'ym',
            ykeys: ['sum'],
            labels: ['@lang("site.total")'],
            lineWidth: 2,
            hideHover: 'auto',
            gridStrokeWidth: 0.4,
            pointSize: 4,
            gridTextFamily: 'Open Sans',
            gridTextSize: 10,
            @isset(request()->phone_number)
            lineColors: ['#B29215'],
            @endisset()
                @isset(request()->hour_number)
            lineColors: ['#1AB244'],
            @endisset()
                @isset(request()->counter_number)
            lineColors: ['#1531B2'],
            @endisset()
        });
    </script>
@endpush
