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
        <th colspan="3"><b>Actions</b></th>
     
      </tr>

      @foreach ($allBooks as $b)
        <tr>
          <td class='align-middle'>{{$b->title}}</td>
          <td class='align-middle'>{{$b->cover}}</td>

          <td class='align-middle'> <a href="{{ URL::to('books/' . $b->id) }}"> <button class="btn btn-primary">Show</button></a> </td>
          <td class='align-middle'> 
            @if (in_array($b->id, $favourites))
                    <form action="{{ route('removeFavourite') }}" method="POST">
                        @csrf
                        {{ method_field('DELETE') }}
                        <input type="hidden" name="book" value="{{ $b->id}}">
                        <button class="btn btn-danger">Remove from My Favourites</button>
                    </form>
            @else
                <form action="{{ route('favourites.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="book" value="{{ $b->id}}">
                    <button class="btn btn-warning">Add to my Favourites</button></a>
                </form>
            @endif
          </td>
          <td class='align-middle'> 
            @if (in_array($b->id, $leases))
                    <form action="{{ route('removeLease') }}" method="POST">
                        @csrf
                        {{ method_field('DELETE') }}
                        <input type="hidden" name="book" value="{{ $b->id}}">
                        <button class="btn btn-primary">Return</button>
                    </form>
            @else
                <form action="{{ route('leases.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="book" value="{{ $b->id}}">
                    <button class="btn btn-success">Lease</button></a>
                </form>
            @endif
          </td>
          <td class='align-middle'>
            <form method="POST" action="">
              @csrf
              <button class="btn btn-success" type="submit" >review</button>
            </form>
          </td>


        
        </tr>
      @endforeach
    </table>
@endsection
