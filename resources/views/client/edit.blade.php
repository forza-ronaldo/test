@extends('layouts/client/app')
@section('content')
<div class="card w-50 m-auto">
    <div class="card-header-pills">
        <h4>
            اعدادات الملف الشخصي
        </h4>
    </div>
    <div class="card-body">
        <form action="{{route('Client.update',$Client->id)}}" method="post">
            @method("PUT")
            @csrf()
            <div>
                <label>اسم المستخدم</label>
                <input class="form-control" type="text" name="user_name" value="{{$Client->user_name}}">
                @error('user_name')
                <div class=" alert alert-danger mt-1">
                    {{$message}}
                </div>
                @enderror()
            </div>
            <div>
                <label>كلمة السر الجديدة</label>
                <input class="form-control" type="text" name="password">
                @error('password')
                <div class=" alert-sm alert-danger mt-1">
                    {{$message}}
                </div>
                @enderror()
            </div>
            <div>
                <label>تاكيد كلمة السر</label>
                <input class="form-control" type="text" name="password_confirmation">

            </div>
            <input class="btn btn-outline-success mt-3 form-control " type="submit" value="حفظ">
        </form>
    </div>

</div>

@endsection()
