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
<div class="container-fluid">
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
    @if(Session::has('success'))
        <div class="alert alert-success">

            {{Session::get('success')}}
        </div>
        @endif
    @if(Session::has('error'))
        <div class="alert alert-danger">

            {{Session::get('error')}}

        </div>
    @endif

<table class="table table-hover table-dark">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">{{__('messages.Commands Name')}}</th>
        <th scope="col">{{__('messages.Price')}}</th>
        <th scope="col">{{__('messages.Item')}}</th>
        <th scope="col">{{__('messages.photo')}}</th>
        <th scope="col">{{__('messages.Operation')}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($commands as $command)
    <tr>
        <th scope="row">{{$command->id}}</th>
        <td>{{$command->nom}}</td>
        <td>{{$command->prix}}</td>
        <td>{{$command->article}}</td>
        <td>{{$command->photo}}</td>

        <td>
            <a href="{{url('commands/edit/'.$command->id)}}" class="btn btn-success">{{__('messages.Edit')}}</a>
            <a href="{{route('commands.delete',$command->id)}}" class="btn btn-danger">{{__('messages.Delete')}}</a>
        </td>
    </tr>
    @endforeach

    </tbody>
</table>
</div>
    </body>
</html>
