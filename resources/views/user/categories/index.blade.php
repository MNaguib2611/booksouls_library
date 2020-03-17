@extends('layouts.app')

@section('content')
    @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
            </div>
    @endif
    <div class="container d-flex align-content-start flex-wrap justify-content-center">
        @for ($i = 0; $i < count($categories); $i++)
            <div class="card mt-3 mr-3 justify-content-center align-center shadow p-3 mb-5 bg-white rounded" style="width: 350px">
                <div class="card-body">
                    <h3 class="card-title"><strong>{{$categories[$i]->name}}</strong></h3>
                    <div class="card-subtitle mb-2 text-muted">{{$count_list[$i]}} books</div>
                    <a href="{{ route('getCategory', $categories[$i]->id)}}"><button class="card-subtitle mb-2 mb-2 btn btn-primary mt-1 rounded">Show Me</button></a>
                </div>
            </div>
        @endfor
        </div>
@endsection
