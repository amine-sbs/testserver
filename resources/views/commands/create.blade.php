<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
      <li class="nav-item active">
        <a class="nav-link" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">{{ $properties['native'] }} <span class="sr-only">   </span></a>
      </li>
      @endforeach


    </ul>
  </div>
</nav>

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
            <button type="submit" class="btn btn-primary">{{__('messages.Save')}}</button>

        </div>

         </form>
            </div>

        </div>

    </body>
</html>
