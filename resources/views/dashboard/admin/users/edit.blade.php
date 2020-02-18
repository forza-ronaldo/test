@extends('layouts.dashboard.app')
@section('content')
    <form action="{{route('dashboard.user.update',$user->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
        <label>bank_id</label>
        <input class="form-control input mb-1 @error('bank_id') is-invalid @enderror" value="{{ $user->bank_id }}" disabled type="text" name="bank_id" placeholder="bank_id" >
        </div>


        <div>
        <label>id_number</label>
        <input class="form-control input mb-1 @error('id_number') is-invalid @enderror" value="{{ $user->id_number }}" disabled type="text" name="id_number" placeholder="Id Number" >
        </div>


        <div>
        <label>user_name</label>
        <input class="form-control input  mb-1 @error('user_name') is-invalid @enderror" value="{{  $user->user_name }}" type="text" name="user_name" placeholder="User Name" >
        </div>


        <div>
        <label>name</label>
        <input class="form-control input mb-1 @error('name') is-invalid @enderror" value="{{  $user->name }}"  type="text" name="name"  placeholder="name" >
        </div>


        <div>
        <label>email</label>
        <input class="form-control input mb-1 @error('email') is-invalid @enderror" value="{{  $user->email }}"  type="email" name="email" placeholder="Email" autocomplete="off" >
        </div>


        <div>
        <label>phone</label>
        <input class="form-control input mb-1 @error('phone') is-invalid @enderror" value="{{  $user->phone }}"  type="text" name="phone" placeholder="Phone" >
        </div>


        <div>
        <label>city</label>
        <input class="form-control input mb-1 @error('city') is-invalid @enderror" value="{{ $user->city }}"  type="text" name="city" placeholder="City" >
        </div>



        <div>
        <label >gender</label>
        <br>
            <label class="radio-inline"><input type="radio" {{$user->gender==0?'checked':''}} value="0" name="gender" > male</label>
            <label class="radio-inline"><input type="radio" {{$user->gender==1?'checked':''}} value="1" name="gender"> female </label>
        </div>

        <!--start permissions section-->
        <?php $models=['users','questions'];?>
        <?php $options=['create','read','update','delete','send'];?>
        <div class="row">
            <div class="col-md-12">
                <h5>@lang('site.permissions')</h5>
                <ul class="cards">
                    @foreach($models as $index=>$model)
                        <li>
                            <a class='mr-2 '>{{$model}} </a>
                        </li>
                        <li>
                            @foreach($options as $option)
                                @if ($option=='send' && $model=='users')

                            @else
                                <label>@lang('site.'.$option)</label>                                       {{-- $user->hasPermission() --}}
                                <input type="checkbox" name="permissions[]"  value="{{$option}}_{{$model}}" {{$user->can($option.'_'.$model)?'checked':''}}>
                            @endif
                            @endforeach
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- end permissions section-->
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <button class="form-control mt-2">@lang('site.edit')</button>
    </form>
@endsection




