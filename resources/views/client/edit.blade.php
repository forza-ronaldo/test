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
                <input class="form-control @error('user_name') is-invalid @enderror()" type="text" name="user_name" value="{{$Client->user_name}}">
                @error('user_name')
                <div class=" alert-sm alert-danger mt-1">
                    {{$message}}
                </div>
                @enderror()
            </div>
            <div>
                <label>كلمة السر الحالية </label>
                <input class="form-control @error('current_password') is-invalid @enderror()" type="text" name="current_password" >
                @error('current_password')
                <div class=" alert-sm alert-danger mt-1">
                    {{$message}}
                </div>
                @enderror()
                @isset($msg_result_check_pass)
                    <div class="alert-sm alert-info mt-1">
                        {{ $msg_result_check_pass }}
                    </div>
                @endisset()
            </div>
            <div>
                <label>كلمة السر الجديدة</label>
                <input class="form-control @error('password') is-invalid @enderror()" type="text" name="password">
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
           <div class=" d-flex ">
            <input class="btn btn-outline-success mt-3 mr-1 form-control-sm " type="submit" value="حفظ">
            <button class="btn btn-outline-danger mt-3 form-control-sm "><a href="{{url()->previous()}}" ></a>رجوع</button>
           </div>

        </form>
    </div>

</div>

@endsection()
