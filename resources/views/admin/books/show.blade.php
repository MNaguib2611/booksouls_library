@extends('admin.layouts.main')

@section('content')
<div class="container">
  <div class="container justify-content-center">
      <div class="col-md-12">
          <div class="card">
            <div class="card-body h-100">
<h1> show book </h1>

<a href="{{ URL::to('admin/books/') }}"> <button>Back</button></a>
<br>
<label>  Title: </label>  
<label>{{$myBook->title}}</label><br>

<label>  Description: </label>
<label>{{$myBook->description}}</label><br>

<label>  Author: </label>
<label>{{$myBook->author}}</label><br>

<label>  Quantity: </label> 
<label>{{$myBook->quantity}}</label><br>

<label>  price: </label>  
<label>{{$myBook->price}}</label><br>

<label>  category: </label>
<label>{{$myCategory->name}}</label><br>


<label>  Cover: </label>
<label>{{$myBook->cover}}</label><br>


@if ($errors->any())
        <strong>Whoops! </strong> there where some problems with your input.<br>
        <ul>
          @foreach ($errors as $error)
            <li>{{$error}}</li>
          @endforeach
        </ul>    
@endif
</div>
</div>
</div>
</div>
</div>
@endsection
