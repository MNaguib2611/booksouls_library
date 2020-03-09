@extends('layouts.app')

@section('content')
<h1 class="ml-2"> list all books </h1>

<button class="btn btn-primary ml-2 mb-2" onclick="location.href='{{ url('admin/books/create') }}'"> Create New Book </button>
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
        <th><b>Update</b></th>
        <th><b>Delete</b></th>
      </tr>

      @foreach ($allBooks as $b)
        <tr>
          <td class='align-middle'>{{$b->title}}</td>
          <td class='align-middle'>{{$b->cover}}</td>

          <td class='align-middle'> <a href="{{ URL::to('admin/books/' . $b->id) }}"> <button class="btn btn-primary">Show</button></a> </td>
          <td class='align-middle'> <a href="{{ URL::to('admin/books/' . $b->id . '/edit') }}"> <button class="btn btn-success">Update</button></a> </td>
          <td class='align-middle'>
                <form method="POST" action="/admin/books/{{$b->id}}">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                  <button class="btn btn-danger" type="submit" >Delete</button>
                 </form>
                </td>


        
        </tr>
      @endforeach
    </table>
@endsection
