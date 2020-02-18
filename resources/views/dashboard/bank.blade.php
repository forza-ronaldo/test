@extends('layouts.dashboard.app')
@section('title','bank')
@section('content')
<div class="row  mt-5 justify-content-end">
    <select class="form-control col-3 ">
        <option>...</option>
        <option>اليوم</option>
        <option>امس</option>
        <option>اسبوع</option>
        <option>شهر</option>
        <option>السنة الحالية</option>
        <option>السنة الماضية</option>
    </select>
</div>{{-- end row --}}
<div class="row  mt-5">
    <div class="col-4">
        <div class="card ">
            <div class="card-body">
                <h5 class="card-title">عدد الفواتير المدفوعة</h5>
                <p class="card-text">Content</p>
            </div>
        </div>
    </div>{{-- end card --}}
    <div class="col-4">
        <div class="card ">
            <div class="card-body">
                <h5 class="card-title">قيمة الفواتير الكلية</h5>
                <p class="card-text">Content</p>
            </div>
        </div>
    </div>{{-- end card --}}
    <div class="col-4">
        <div class="card ">
            <div class="card-body">
                <h5 class="card-title">قيمة الارباح</h5>
                <p class="card-text">Content</p>
            </div>
        </div>
    </div>{{-- end card --}}
</div>{{-- end row --}}
<div class="row justify-content-center">
    <table class="table table-light col-8 m-3 text-center">
        <thead class="thead-light">
            <tr>
                <th class=""> رقم الحساب</th>
                <th class="">الاسم</th>
                <th class="">المبلغ المخصوم</th>
                <th class="">تاريخ الخصم</th>
                <th class="">الرصيد الكلي</th>

            </tr>
        </thead>
        <tbody >
            <tr>
                <td>dd</td>
                <td>dd</td>
                <td>dd</td>
                <td>dd</td>
                <td>dd</td>

            </tr>
        </tbody>
        <tfoot>

        </tfoot>
    </table>
</div>{{-- end row --}}
@endsection
