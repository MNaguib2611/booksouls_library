@extends('layouts.app')

@section('content')
<h1 class="ml-2"> list all books </h1>

@if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>	
                <strong>{{ $message }}</strong>
        </div>
@endif


<table class="table table-bordered justify-content-center text-center ">
      <tr class="thead-dark">
        <th><b>Title</b></th>
        <th><b>Cover</b></th>
        <th><b>Details</b></th>
       
     
      </tr>

      @foreach ($allBooks as $b)
        <tr>
          <td class='align-middle'>{{$b->title}}</td>
          <td class='align-middle'>{{$b->cover}}</td>

          <td class='align-middle'> <a href="{{ URL::to('books/' . $b->id) }}"> <button class="btn btn-primary">Show</button></a> </td>
          


        
        </tr>
      @endforeach
    </table>
@endsection
