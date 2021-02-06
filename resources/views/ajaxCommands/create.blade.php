@extends('layouts.app')
@section('content')
    <div class="container">
    <div class="flex-center position-ref full-height">

        <div class="content">
            <div class="title m-b-md">
                {{ __('messages.Add your commands')}}
            </div>
            @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
            <br>
            <form method="POST" action="{{route('commands.store')}}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="exampleInputEmail1">{{__('messages.Photo')}}</label>
                    <input type="file" class="form-control" name="photo"  >
                    @error('photo')
                    <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">{{__('messages.Commands Name ar')}}</label>
                    <input type="text" class="form-control" name="nom_ar"  placeholder="{{__('messages.Commands Name')}}">
                    @error('nom_ar')
                    <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">{{__('messages.Commands Name en')}}</label>
                    <input type="text" class="form-control" name="nom_en"  placeholder="{{__('messages.Commands Name')}}">
                    @error('nom_en')
                    <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">{{__('messages.Price')}}</label>
                    <input type="text" class="form-control" name="prix"  placeholder="{{__('messages.Price')}}">
                    @error('prix')
                    <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">{{__('messages.Item ar')}}</label>
                    <input type="text" class="form-control" name="article_ar"  placeholder="{{__('messages.Item')}}">
                    @error('article_ar')
                    <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">{{__('messages.Item en')}}</label>
                    <input type="text" class="form-control" name="article_en"  placeholder="{{__('messages.Item')}}">
                    @error('article_en')
                    <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-check">


                </div>
                <div class="form-check">
                    <button id="save-command" class="btn btn-primary">{{__('messages.Save')}}</button>

                </div>

            </form>
        </div>

    </div>
    </div>

@stop

@section('scripts')
    <script>
        $(document).on('click','#save-command', function (e) {
            $.ajax({
                type:'post',
                url:'{{route('ajax.commands.store')}}',
                data:{
                    '_token':"{{csrf_token()}}",
                },
                success: function (data){

                },
                error: function (reject) {

                }

            });


        });
    </script>
    @stop
