@extends('layouts/client/app')
@section('content')
    <div class="row m-1">
        <div class="col-4">
            <h3>اتصالات</h3>
            <div class="under-line-blue mb-2 "></div>
            @foreach($places_telecome as $pl)
                <div class="card mb-2  p-2">
                    <div class="card-header">
                        {{$pl->name}}
                    </div>
                    <div class="card-body">
                        {{$pl->location}}
                    </div>

                    <a href="{{route('places.show',$pl->id)}}" class="btn btn-outline-secondary form-control-sm  w-50 m-auto ">عرض الموقع
                   <i class="fa fa-location-arrow"></i>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="col-4" >
            <h3>مياه</h3>
            <div class="under-line-blue mb-2"></div>
            @foreach($places_water as $pl)
                <div class="card mb-2  p-2">
                    <div class="card-header">
                        {{$pl->name}}
                    </div>
                    <div class="card-body">
                        {{$pl->location}}
                    </div>

                    <a href="{{route('places.show',$pl->id)}}" class="btn btn-outline-secondary form-control-sm  w-50 m-auto ">عرض الموقع
                        <i class="fa fa-location-arrow"></i>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="col-4">
            <h3>كهرباء</h3>
            <div class="under-line-blue mb-2"></div>
            @foreach($places_electricity as $pl)
                <div class="card mb-2  p-2">
                    <div class="card-header">
                        {{$pl->name}}
                    </div>
                    <div class="card-body">
                        {{$pl->location}}
                    </div>

                    <a href="{{route('places.show',$pl->id)}}" class="btn btn-outline-secondary form-control-sm  w-50 m-auto ">عرض الموقع
                        <i class="fa fa-location-arrow"></i>
                    </a>
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
