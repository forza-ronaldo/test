@extends('layouts.dashboard.app')
@section('title','admin')
@section('content')
<div class="row  mt-5 justify-content-end">
    <form class="col-5">
        <select class="form-control filter-date" name="searsh" >
        <option value="">...</option>
        <option class="btn-sub" value="0" {{request()->searsh==0?'selected':''}}>اليوم</option>
        <option class="btn-sub" value="yesterday"  {{request()->searsh=='yesterday'?'selected':''}}>امس</option>
        <option class="btn-sub" value="7" {{request()->searsh==7?'selected':''}}>اسبوع</option>
        <option class="btn-sub" value="30" {{request()->searsh==30?'selected':''}}>شهر</option>
        <option class="btn-sub" value="current_year" {{request()->searsh=='current_year'?'selected':''}}>السنة الحالية</option>
        <option class="btn-sub" value="last_year" {{request()->searsh=='last_year'?'selected':''}}>السنة الماضية</option>
        <option value="all" {{request()->searsh=='all'?'selected':''}}>الاجمالي</option>


    </select>
</form>

</div>{{-- end row --}}
<div class="row  mt-5">
    <div class="col-4">
        <div class="card bg-info">
            <div class="card-body">
                <h5 class="card-title">مياه</h5>
                <p class="card-text">{{is_null($count_water)?0:$count_water}}</p>
            </div>
        </div>
    </div>{{-- end card --}}
    <div class="col-4">
        <div class="card bg-success">
            <div class="card-body">
                <h5 class="card-title">كهرباء</h5>
                <p class="card-text">{{is_null($count_electricty)?0:$count_electricty}}</p>
            </div>
        </div>
    </div>{{-- end card --}}
    <div class="col-4">
        <div class="card bg-warning">
            <div class="card-body">
                <h5 class="card-title">اتصالات</h5>
                <p class="card-text">
                {{is_null($count_telecome)?0:$count_telecome }}
                </p>
            </div>
        </div>
    </div>{{-- end card --}}

</div>{{-- end row --}}
<div class="row mt-5">

    <div class="col-6">
        <div class="card bg-danger  ">
            <div class="card-body">
                <h5 class="card-title">عدد الأعضاء
                    المسجلين
                    </h5>
                <p class="card-text">{{ is_null($count_user)?0:$count_user}}</p>
            </div>
        </div>
    </div>{{-- end card --}}
    <div class="col-6">
        <div class="card bg-secondary">
            <div class="card-body">
                <h5 class="card-title">الاجمالي</h5>
                <p class="card-text">{{ $count_total }}</p>
            </div>
        </div>
    </div>{{-- end card --}}
</div>{{-- end row --}}


</div>
@endsection
