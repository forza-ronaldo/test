@extends('layouts/client/app')
@section('content')


    <button type="submit" class="form-control btn-primary col-2  m-3">
        <a href="{{route('Question.create')}}" class="text-white">اضف سوال </a>
    </button>

   <div class="row m-1">
       <div class="col-4">
           <h3>اتصالات</h3>
           <div class="under-line-blue mb-2"></div>
          @foreach($questions_telecome as $qt)
               <button class="accordion">{{$qt->text_question}}</button>
               <div class="panel">
                   <p>{{$qt->text_answer}}</p>
               </div>
           @endforeach


       </div>
       <div class="col-4" >
           <h3>مياه</h3>
           <div class="under-line-blue mb-2"></div>

           @foreach($questions_water as $qt)
               <button class="accordion">{{$qt->text_question}}</button>
               <div class="panel">
                   <p>{{$qt->text_answer}}</p>
               </div>
           @endforeach
       </div>
       <div class="col-4">
           <h3>كهرباء</h3>
           <div class="under-line-blue mb-2"></div>
           @foreach($questions_electricity as $qt)
               <button class="accordion">{{$qt->text_question}}</button>
               <div class="panel">
                   <p>{{$qt->text_answer}}</p>
               </div>
           @endforeach


       </div>
   </div>
    @endsection
@push('script')
    <script>
        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function() {
                this.classList.toggle("activee");
                var panel = this.nextElementSibling;
                if (panel.style.maxHeight) {
                    panel.style.maxHeight = null;
                } else {
                    panel.style.maxHeight = panel.scrollHeight + "px";
                }
            });
        }
    </script>
    @endpush
@push('style')
    <style>
    .accordion {
        background-color: #eee;
        color: #444;
        cursor: pointer;
        padding: 18px;
        width: 100%;
        border: none;
        text-align: left;
        outline: none;
        font-size: 15px;
        transition: 0.4s;
    }

    .activee, .accordion:hover {
        background-color: #ccc;
    }

    .accordion:after {
        content: '\002B';
        color: #777;
        font-weight: bold;
        float: right;
        margin-left: 5px;
    }

    .activee:after {
        content: "\2212";
    }

    .panel {
        padding: 0 18px;
        background-color: white;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.2s ease-out;
    }
    </style>
    @endpush
