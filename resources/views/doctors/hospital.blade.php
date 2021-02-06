@extends('layouts.app')
@section('content')
    <div class="container">
    <div class="flex-center position-ref full-height">

        <div class="content">
            <div class="title m-b-md">
               <h2>Les Cliniques</h2>
            </div>

            <br>

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">adresse</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($hospitals) && $hospitals->count() > 0)
                    @foreach($hospitals as $hospital)
                <tr>
                    <th scope="row">{{$hospital->id}}</th>
                    <td>{{$hospital->name}}</td>
                    <td>{!! $hospital->adresse !!}</td>
                    <td>
                        <a href="{{route('hospital.doctors',$hospital->id)}}" class="btn btn-success">View doctors</a>
                        <a href="{{route('hospital.delete',$hospital->id)}}" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                    @endforeach
                    @endif

                </tbody>
            </table>
        </div>

    </div>
    </div>

@stop


