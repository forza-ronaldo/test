@extends('layouts.dashboard.app')
@section('title','questions')
@section('content')
<div class="row justify-content-center mt-5">

    <div class="card col-6" >
        <h4 class="text-primary text-center"></h4>
            <div class="card">
                <form id="form_reply" action="" method="post">
                    @csrf()
                    <div class="card-header text-center">
                        <h5>نافذة الاجابة</h5>
                    </div>
                    <div class="card-body text-center">
                        <table dir="rtl" class="table table-striped " id="table-answer">
                            <thead>
                                <tr>
                                <th scope="col">الجواب</th>
                                <th scope="col">خيارات</th>
                                </tr>
                            </thead>
                        </table>
                        <td colspan="2"><input type="submit" class="btn btn-primary form-control disabled btn-send-reply" value="ارسال"><i class="fa fa-send"></i> </td>
                    </div>
                </form>
           </div>
    </div>{{-- end card --}}

    <div class="card col-6" >
        <h4 class="text-primary text-center"></h4>
            <div class="card">
                <div class="card-header text-center">
                    <h5>الاسئلة التي تنتظر الرد</h5>
                    <small>{{ $questions->total() }}</small>
                </div>
                <div class="card-body text-center">
                    <table dir="rtl" class="table table-striped table-questions">
                        <thead>
                            <tr>
                            <th scope="col">رقم</th>
                            <th scope="col">السؤال</th>
                            <th scope="col">خيارات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($questions as $question )
                            <tr>
                                <th>{{ $question->id }}</th>
                                <th scope="row">
                                    <textarea class="form-control">{{$question->text_question}}</textarea>
                                </th>
                                <td>
                                    <form class="d-inline" action="{{ route('dashboard.question.destroy',$question->id)}}" method="POST">
                                        @csrf()
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" >
                                        <i class="fa fa-trash"> حذف</i>
                                        </button>
                                    </form>

                                <button class="btn btn-sm btn-success btn-reply"
                                        data-id="{{ $question->id  }}"
                                        data-url="{{route('dashboard.questionSendReply',$question->id) }}" >
                                    <i class="fa fa-reply" aria-hidden="true"> رد</i>
                                </button>
                                </td>
                            </tr>
                            @endforeach

                            </tbody>
                    </table>
                </div>
                {{$questions->appends(request()->query())->links()}}

        </div>
    </div>{{-- end card --}}
</div>{{-- end row --}}
@endsection
