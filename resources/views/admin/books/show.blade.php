         

@extends('admin.layouts.main')
{{ HTML::style('css/likebutton.css') }}
{{ HTML::style('css/bookcard.css') }}
{{ HTML::style('css/rating.css') }}
{{ HTML::style('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css') }}
{{ HTML::style('css/showbook.css') }}

@section('content')

@if ($errors->any())
        <strong>Whoops! </strong>
        <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
          @endforeach
        </ul>    
        </div>
@endif
<a href="{{ URL::to('admin/books/') }}"> <button class="btn btn-primary ml-5">Go Back</button></a>

  <div class="container-fluid" style="margin-left:5rem; width:80%;">

    <!-- 3D book -->
    <div class="thecover"> 
      <div class="book3D">
        <div class="book3D-cover">
          <img class="book-cover" src="{{$myBook->cover}}" />
          <div class="book3D-top"></div>
          <div class="book3D-right"></div> 
        </div>
      </div>
    </div>

    <div class="ml-4 book-details">  
      <h1 >{{$myBook->title}}</h1><br>
      @if($myCategory)
        <button  class="alert alert-primary" disabled>{{ $myCategory->name }}</button>
      @else
        <div class="alert alert-secondary text-center col-6" style="margin-top:-.8rem !important;">No Category for this book</div>
      @endif
      <h3 class="card-text mt-4"> <strong>by</strong> <strong class="text-primary">{{$myBook->author}}</strong></h3>
      <h3 class="card-text mt-4" style="width:30rem;">{{$myBook->description}}</h3>
      <div  class="book-rating">
        <div class="copies text-muted">
            <h5>@if($myBook->quantity == 1) {{$myBook->quantity}} copy available @elseif($myBook->quantity == 0) <div class="alert alert-danger nocopies">No copies available </div> @else {{$myBook->quantity}} copies available @endif</h5>
        </div>
        <div class="price">
            <span class="currency">$</span>
            <span class="value">{{$myBook->price}}</span>
            <span class="duration">day</span>
        </div>
      </div>
      <div class="book-rating">
      <div class="rating rating-card"> 
            <span class="fa fa-star @if($myBook->rate > 4 )@if($myBook->rate == 4.5)fa-star-half-o @endif checked @else fa-star-o @endif"></span>
            <span class="fa fa-star @if($myBook->rate > 3 )@if($myBook->rate == 3.5)fa-star-half-o @endif checked @else fa-star-o @endif"></span>
            <span class="fa fa-star @if($myBook->rate > 2 )@if($myBook->rate == 2.5)fa-star-half-o @endif checked @else fa-star-o @endif"></span>
            <span class="fa fa-star @if($myBook->rate > 1 )@if($myBook->rate == 1.5)fa-star-half-o @endif checked @else fa-star-o @endif"></span>
            <span class="fa fa-star @if($myBook->rate > 0 )@if($myBook->rate == 0.5)fa-star-half-o @endif checked @else fa-star-o @endif"></span>
      </div>
     
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

@endsection



