@extends('layouts/client/app')
@section('content')
    <form action="{{route('Question.store')}}" method="post">
        @csrf()
        <div class="card  m-auto col-6">
            <div class="card-header text-center"> اضف سؤال</div>
            <div class="card-body">
                <div class="form-group">
                        <label>حدد الفئة التي ينتمي لها السوال</label>

                        <div>
                            <input type="radio"  value="0" name="center_type" id="water">
                            <label class="radio-inline" for="water"> ماء</label>
                        </div>
                        <div>
                            <input type="radio"  value="1" name="center_type"  id="electricity">
                            <label class="radio-inline" for="electricity">كهرباء </label>
                        </div>
                    <div>
                        <input type="radio"  value="2" name="center_type"  id="telecome">
                        <label class="radio-inline mr-1" for="telecome"> اتصالات </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="question">السؤال </label>
                    <textarea class=" form-control" rows="4" name="text_question" placeholder="إضافة سؤال جديد"></textarea>
                </div>
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <input type="submit" class="form-control btn btn-success">
            </div>
        </div>
    </form>
@endsection
@push('style')
<style>
    .card{
        padding-left: 0px;
        padding-right: 0px;
    }
</style>
@endpush
