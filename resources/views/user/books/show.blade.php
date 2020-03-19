@extends('layouts.app')
{{ HTML::style('css/likebutton.css') }}
{{ HTML::style('css/bookcard.css') }}
{{ HTML::style('css/rating.css') }}
{{ HTML::style('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css') }}
{{ HTML::style('css/showbook.css') }}
{{ HTML::style('css/accordion.css') }}

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

  <div class="container-fluid" style="width:100% !important;">

    <!-- 3D book -->
    <div class="thecover" style="margin-left: 8rem;"> 
      <div class="book3D">
        <div class="book3D-cover">
          <img class="book-cover" src="{{$book->cover}}" />
          <div class="book3D-top"></div>
          <div class="book3D-right"></div> 
        </div>
      </div>
    </div>

    <div class="ml-4 book-details">  
      <h1 >{{$book->title}}</h1><br>
      <div class="book-rating float-right " style="margin-top:-4.5rem;">
        <div class="heart-btn">  
          <div class="liked-button">
              <input type="checkbox" class="love-checkbox" id="{{$book->id}}" onclick="handlingFav({{$book->id}}, event)" @if (in_array($book->id, $favourites)) checked @endif/>
              <label for="{{$book->id}}">
                  <svg class="heart-svg" viewBox="467 392 58 57" xmlns="http://www.w3.org/2000/svg">
                      <g class="Group" fill="none" fill-rule="evenodd" transform="translate(467 392)">
                          <path d="M29.144 20.773c-.063-.13-4.227-8.67-11.44-2.59C7.63 28.795 28.94 43.256 29.143 43.394c.204-.138 21.513-14.6 11.44-25.213-7.214-6.08-11.377 2.46-11.44 2.59z" class="heart" fill="#AAB8C2"/>
                          <circle class="main-circ" fill="#E2264D" opacity="0" cx="29.5" cy="29.5" r="1.5"/>

                          <g class="grp7" opacity="0" transform="translate(7 6)">
                              <circle class="oval1" fill="#9CD8C3" cx="2" cy="6" r="2"/>
                              <circle class="oval2" fill="#8CE8C3" cx="5" cy="2" r="2"/>
                          </g>

                          <g class="grp6" opacity="0" transform="translate(0 28)">
                              <circle class="oval1" fill="#CC8EF5" cx="2" cy="7" r="2"/>
                              <circle class="oval2" fill="#91D2FA" cx="3" cy="2" r="2"/>
                          </g>

                          <g class="grp3" opacity="0" transform="translate(52 28)">
                              <circle class="oval2" fill="#9CD8C3" cx="2" cy="7" r="2"/>
                              <circle class="oval1" fill="#8CE8C3" cx="4" cy="2" r="2"/>
                          </g>

                          <g class="grp2" opacity="0" transform="translate(44 6)">
                              <circle class="oval2" fill="#CC8EF5" cx="5" cy="6" r="2"/>
                              <circle class="oval1" fill="#CC8EF5" cx="2" cy="2" r="2"/>
                          </g>

                          <g class="grp5" opacity="0" transform="translate(14 50)">
                              <circle class="oval1" fill="#91D2FA" cx="6" cy="5" r="2"/>
                              <circle class="oval2" fill="#91D2FA" cx="2" cy="2" r="2"/>
                          </g>

                          <g class="grp4" opacity="0" transform="translate(35 50)">
                              <circle class="oval1" fill="#F48EA7" cx="6" cy="5" r="2"/>
                              <circle class="oval2" fill="#F48EA7" cx="2" cy="2" r="2"/>
                          </g>

                          <g class="grp1" opacity="0" transform="translate(24)">
                              <circle class="oval1" fill="#9FC7FA" cx="2.5" cy="3" r="2"/>
                              <circle class="oval2" fill="#9FC7FA" cx="7.5" cy="2" r="2"/>
                          </g>
                      </g>
                  </svg>
              </label>
          </div>
        </div>
    </div>
    <h3 class="card-text" style="margin:-1.5rem 0 2.5rem 1rem; font-size:1.3rem !important;"> <strong>by</strong> <strong class="text-primary ">{{$book->author}}</strong></h3>
    @if($category)
      <a href="{{ route('getCategory', $category->id)}}" class="alert alert-primary">{{ $category->name }}</a>
    @else
      <div class="alert alert-secondary text-center col-6" style="margin-top:-.8rem !important;">No Category for this book</div>
    @endif
      <div class="rating rating-card float-right" style="margin-top:0; margin-right:-2rem;"> 
            <span class="fa fa-star @if($book->rate > 4 )@if($book->rate == 4.5)fa-star-half-o @endif checked @else fa-star-o @endif"></span>
            <span class="fa fa-star @if($book->rate > 3 )@if($book->rate == 3.5)fa-star-half-o @endif checked @else fa-star-o @endif"></span>
            <span class="fa fa-star @if($book->rate > 2 )@if($book->rate == 2.5)fa-star-half-o @endif checked @else fa-star-o @endif"></span>
            <span class="fa fa-star @if($book->rate > 1 )@if($book->rate == 1.5)fa-star-half-o @endif checked @else fa-star-o @endif"></span>
            <span class="fa fa-star @if($book->rate > 0 )@if($book->rate == 0.5)fa-star-half-o @endif checked @else fa-star-o @endif"></span>
      </div>
      <h3 class="card-text mt-5 mb-5" style="width:30rem;">{{$book->description}}</h3>
      <div  class="book-rating">
        <div class="copies text-muted ml-1" id="book-quantity">
            <h5>@if($book->quantity == 1) {{$book->quantity}} copy available @elseif($book->quantity == 0) <div class="alert alert-danger nocopies text-center col-12">No copies available </div> @else {{$book->quantity}} copies available @endif</h5>
        </div>
        <div class="price">
            <span class="currency">$</span>
            <span class="value">{{$book->price}}</span>
            <span class="duration">day</span>
        </div>
        
      </div>
    <div class="text-center" id="book-actions">
      @if(!$userLease)
          <a href="{{route('leases.create.book',$book->id)}}"><button class="btn btn-success col-5" style='height:3rem; @if($book->quantity == 0) cursor:default !important;" disabled @endif'> Lease </button></a>
        @else
          <button class="btn btn-primary col-5" style="margin-left:-1rem; height:3rem" onclick=deleteLease()> Return </button> 
          @if( $userLease->remaining == 1)
            <h6 class="copies text-muted ml-3" style="display:inline-block;">You still have {{$userLease->remaining}} Day in your lease</h6> 
          @elseif($userLease->remaining == 0) 
            <h6 class="copies text-danger" style="display:inline-block; width:16rem; margin-left:-1rem;">Your Lease ends today!!</h6> 
          @else 
            <h6 class="copies text-muted ml-3" style="display:inline-block;">You still have {{$userLease->remaining}} Days in your lease</h6>
          @endif
        @endif
    </div>
  </div>
  @if(!$userReview)
  <div class="reviewing-box">
      <h5 class="alert alert-info">Your reviews are welcomed</h5>
      <div class="row review-cont" id="post-review-box">
        <div class="col-md-12">
        <form accept-charset="UTF-8" id="review-form" action="">
          <div class="rating">
              <input type="radio" name="rating" id="rating-5" value="5" >
              <label for="rating-5"></label>
              <input type="radio" name="rating" id="rating-4" value="4">
              <label for="rating-4"></label>
              <input type="radio" name="rating" id="rating-3" value="3">
              <label for="rating-3"></label>
              <input type="radio" name="rating" id="rating-2" value="2">
              <label for="rating-2"></label>
              <input type="radio" name="rating" id="rating-1" value="1" required>
              <label for="rating-1"></label>
            <div class="emoji-wrapper">
              <div class="emoji">
                <svg class="rating-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <circle cx="256" cy="256" r="256" fill="#ffd93b"/>
                <path d="M512 256c0 141.44-114.64 256-256 256-80.48 0-152.32-37.12-199.28-95.28 43.92 35.52 99.84 56.72 160.72 56.72 141.36 0 256-114.56 256-256 0-60.88-21.2-116.8-56.72-160.72C474.8 103.68 512 175.52 512 256z" fill="#f4c534"/>
                <ellipse transform="scale(-1) rotate(31.21 715.433 -595.455)" cx="166.318" cy="199.829" rx="56.146" ry="56.13" fill="#fff"/>
                <ellipse transform="rotate(-148.804 180.87 175.82)" cx="180.871" cy="175.822" rx="28.048" ry="28.08" fill="#3e4347"/>
                <ellipse transform="rotate(-113.778 194.434 165.995)" cx="194.433" cy="165.993" rx="8.016" ry="5.296" fill="#5a5f63"/>
                <ellipse transform="scale(-1) rotate(31.21 715.397 -1237.664)" cx="345.695" cy="199.819" rx="56.146" ry="56.13" fill="#fff"/>
                <ellipse transform="rotate(-148.804 360.25 175.837)" cx="360.252" cy="175.84" rx="28.048" ry="28.08" fill="#3e4347"/>
                <ellipse transform="scale(-1) rotate(66.227 254.508 -573.138)" cx="373.794" cy="165.987" rx="8.016" ry="5.296" fill="#5a5f63"/>
                <path d="M370.56 344.4c0 7.696-6.224 13.92-13.92 13.92H155.36c-7.616 0-13.92-6.224-13.92-13.92s6.304-13.92 13.92-13.92h201.296c7.696.016 13.904 6.224 13.904 13.92z" fill="#3e4347"/>
              </svg>
                <svg class="rating-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <circle cx="256" cy="256" r="256" fill="#ffd93b"/>
                <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534"/>
                <path d="M328.4 428a92.8 92.8 0 0 0-145-.1 6.8 6.8 0 0 1-12-5.8 86.6 86.6 0 0 1 84.5-69 86.6 86.6 0 0 1 84.7 69.8c1.3 6.9-7.7 10.6-12.2 5.1z" fill="#3e4347"/>
                <path d="M269.2 222.3c5.3 62.8 52 113.9 104.8 113.9 52.3 0 90.8-51.1 85.6-113.9-2-25-10.8-47.9-23.7-66.7-4.1-6.1-12.2-8-18.5-4.2a111.8 111.8 0 0 1-60.1 16.2c-22.8 0-42.1-5.6-57.8-14.8-6.8-4-15.4-1.5-18.9 5.4-9 18.2-13.2 40.3-11.4 64.1z" fill="#f4c534"/>
                <path d="M357 189.5c25.8 0 47-7.1 63.7-18.7 10 14.6 17 32.1 18.7 51.6 4 49.6-26.1 89.7-67.5 89.7-41.6 0-78.4-40.1-82.5-89.7A95 95 0 0 1 298 174c16 9.7 35.6 15.5 59 15.5z" fill="#fff"/>
                <path d="M396.2 246.1a38.5 38.5 0 0 1-38.7 38.6 38.5 38.5 0 0 1-38.6-38.6 38.6 38.6 0 1 1 77.3 0z" fill="#3e4347"/>
                <path d="M380.4 241.1c-3.2 3.2-9.9 1.7-14.9-3.2-4.8-4.8-6.2-11.5-3-14.7 3.3-3.4 10-2 14.9 2.9 4.9 5 6.4 11.7 3 15z" fill="#fff"/>
                <path d="M242.8 222.3c-5.3 62.8-52 113.9-104.8 113.9-52.3 0-90.8-51.1-85.6-113.9 2-25 10.8-47.9 23.7-66.7 4.1-6.1 12.2-8 18.5-4.2 16.2 10.1 36.2 16.2 60.1 16.2 22.8 0 42.1-5.6 57.8-14.8 6.8-4 15.4-1.5 18.9 5.4 9 18.2 13.2 40.3 11.4 64.1z" fill="#f4c534"/>
                <path d="M155 189.5c-25.8 0-47-7.1-63.7-18.7-10 14.6-17 32.1-18.7 51.6-4 49.6 26.1 89.7 67.5 89.7 41.6 0 78.4-40.1 82.5-89.7A95 95 0 0 0 214 174c-16 9.7-35.6 15.5-59 15.5z" fill="#fff"/>
                <path d="M115.8 246.1a38.5 38.5 0 0 0 38.7 38.6 38.5 38.5 0 0 0 38.6-38.6 38.6 38.6 0 1 0-77.3 0z" fill="#3e4347"/>
                <path d="M131.6 241.1c3.2 3.2 9.9 1.7 14.9-3.2 4.8-4.8 6.2-11.5 3-14.7-3.3-3.4-10-2-14.9 2.9-4.9 5-6.4 11.7-3 15z" fill="#fff"/>
              </svg>
                <svg class="rating-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <circle cx="256" cy="256" r="256" fill="#ffd93b"/>
                <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534"/>
                <path d="M336.6 403.2c-6.5 8-16 10-25.5 5.2a117.6 117.6 0 0 0-110.2 0c-9.4 4.9-19 3.3-25.6-4.6-6.5-7.7-4.7-21.1 8.4-28 45.1-24 99.5-24 144.6 0 13 7 14.8 19.7 8.3 27.4z" fill="#3e4347"/>
                <path d="M276.6 244.3a79.3 79.3 0 1 1 158.8 0 79.5 79.5 0 1 1-158.8 0z" fill="#fff"/>
                <circle cx="340" cy="260.4" r="36.2" fill="#3e4347"/>
                <g fill="#fff">
                  <ellipse transform="rotate(-135 326.4 246.6)" cx="326.4" cy="246.6" rx="6.5" ry="10"/>
                  <path d="M231.9 244.3a79.3 79.3 0 1 0-158.8 0 79.5 79.5 0 1 0 158.8 0z"/>
                </g>
                <circle cx="168.5" cy="260.4" r="36.2" fill="#3e4347"/>
                <ellipse transform="rotate(-135 182.1 246.7)" cx="182.1" cy="246.7" rx="10" ry="6.5" fill="#fff"/>
              </svg>
                <svg class="rating-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
              <circle cx="256" cy="256" r="256" fill="#ffd93b"/>
              <path d="M407.7 352.8a163.9 163.9 0 0 1-303.5 0c-2.3-5.5 1.5-12 7.5-13.2a780.8 780.8 0 0 1 288.4 0c6 1.2 9.9 7.7 7.6 13.2z" fill="#3e4347"/>
              <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534"/>
              <g fill="#fff">
                <path d="M115.3 339c18.2 29.6 75.1 32.8 143.1 32.8 67.1 0 124.2-3.2 143.2-31.6l-1.5-.6a780.6 780.6 0 0 0-284.8-.6z"/>
                <ellipse cx="356.4" cy="205.3" rx="81.1" ry="81"/>
              </g>
              <ellipse cx="356.4" cy="205.3" rx="44.2" ry="44.2" fill="#3e4347"/>
              <g fill="#fff">
                <ellipse transform="scale(-1) rotate(45 454 -906)" cx="375.3" cy="188.1" rx="12" ry="8.1"/>
                <ellipse cx="155.6" cy="205.3" rx="81.1" ry="81"/>
              </g>
              <ellipse cx="155.6" cy="205.3" rx="44.2" ry="44.2" fill="#3e4347"/>
              <ellipse transform="scale(-1) rotate(45 454 -421.3)" cx="174.5" cy="188" rx="12" ry="8.1" fill="#fff"/>
              </svg>
                    <svg class="rating-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <circle cx="256" cy="256" r="256" fill="#ffd93b"/>
                    <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534"/>
                    <path d="M232.3 201.3c0 49.2-74.3 94.2-74.3 94.2s-74.4-45-74.4-94.2a38 38 0 0 1 74.4-11.1 38 38 0 0 1 74.3 11.1z" fill="#e24b4b"/>
                    <path d="M96.1 173.3a37.7 37.7 0 0 0-12.4 28c0 49.2 74.3 94.2 74.3 94.2C80.2 229.8 95.6 175.2 96 173.3z" fill="#d03f3f"/>
                    <path d="M215.2 200c-3.6 3-9.8 1-13.8-4.1-4.2-5.2-4.6-11.5-1.2-14.1 3.6-2.8 9.7-.7 13.9 4.4 4 5.2 4.6 11.4 1.1 13.8z" fill="#fff"/>
                    <path d="M428.4 201.3c0 49.2-74.4 94.2-74.4 94.2s-74.3-45-74.3-94.2a38 38 0 0 1 74.4-11.1 38 38 0 0 1 74.3 11.1z" fill="#e24b4b"/>
                    <path d="M292.2 173.3a37.7 37.7 0 0 0-12.4 28c0 49.2 74.3 94.2 74.3 94.2-77.8-65.7-62.4-120.3-61.9-122.2z" fill="#d03f3f"/>
                    <path d="M411.3 200c-3.6 3-9.8 1-13.8-4.1-4.2-5.2-4.6-11.5-1.2-14.1 3.6-2.8 9.7-.7 13.9 4.4 4 5.2 4.6 11.4 1.1 13.8z" fill="#fff"/>
                    <path d="M381.7 374.1c-30.2 35.9-75.3 64.4-125.7 64.4s-95.4-28.5-125.8-64.2a17.6 17.6 0 0 1 16.5-28.7 627.7 627.7 0 0 0 218.7-.1c16.2-2.7 27 16.1 16.3 28.6z" fill="#3e4347"/>
                    <path d="M256 438.5c25.7 0 50-7.5 71.7-19.5-9-33.7-40.7-43.3-62.6-31.7-29.7 15.8-62.8-4.7-75.6 34.3 20.3 10.4 42.8 17 66.5 17z" fill="#e24b4b"/>
                  </svg>
                    <svg class="rating-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <g fill="#ffd93b">
                      <circle cx="256" cy="256" r="256"/>
                      <path d="M512 256A256 256 0 0 1 56.8 416.7a256 256 0 0 0 360-360c58 47 95.2 118.8 95.2 199.3z"/>
                    </g>
                    <path d="M512 99.4v165.1c0 11-8.9 19.9-19.7 19.9h-187c-13 0-23.5-10.5-23.5-23.5v-21.3c0-12.9-8.9-24.8-21.6-26.7-16.2-2.5-30 10-30 25.5V261c0 13-10.5 23.5-23.5 23.5h-187A19.7 19.7 0 0 1 0 264.7V99.4c0-10.9 8.8-19.7 19.7-19.7h472.6c10.8 0 19.7 8.7 19.7 19.7z" fill="#e9eff4"/>
                    <path d="M204.6 138v88.2a23 23 0 0 1-23 23H58.2a23 23 0 0 1-23-23v-88.3a23 23 0 0 1 23-23h123.4a23 23 0 0 1 23 23z" fill="#45cbea"/>
                    <path d="M476.9 138v88.2a23 23 0 0 1-23 23H330.3a23 23 0 0 1-23-23v-88.3a23 23 0 0 1 23-23h123.4a23 23 0 0 1 23 23z" fill="#e84d88"/>
                    <g fill="#38c0dc">
                      <path d="M95.2 114.9l-60 60v15.2l75.2-75.2zM123.3 114.9L35.1 203v23.2c0 1.8.3 3.7.7 5.4l116.8-116.7h-29.3z"/>
                    </g>
                    <g fill="#d23f77">
                      <path d="M373.3 114.9l-66 66V196l81.3-81.2zM401.5 114.9l-94.1 94v17.3c0 3.5.8 6.8 2.2 9.8l121.1-121.1h-29.2z"/>
                    </g>
                    <path d="M329.5 395.2c0 44.7-33 81-73.4 81-40.7 0-73.5-36.3-73.5-81s32.8-81 73.5-81c40.5 0 73.4 36.3 73.4 81z" fill="#3e4347"/>
                    <path d="M256 476.2a70 70 0 0 0 53.3-25.5 34.6 34.6 0 0 0-58-25 34.4 34.4 0 0 0-47.8 26 69.9 69.9 0 0 0 52.6 24.5z" fill="#e24b4b"/>
                    <path d="M290.3 434.8c-1 3.4-5.8 5.2-11 3.9s-8.4-5.1-7.4-8.7c.8-3.3 5.7-5 10.7-3.8 5.1 1.4 8.5 5.3 7.7 8.6z" fill="#fff" opacity=".2"/>
                  </svg>
              </div>
            </div>
          </div>
          <div class="form-group">
            <textarea class="form-control" name="comment" placeholder="Enter your comments here..." cols="100" rows="5"></textarea>
          </div>
          <div class="text-right">
            <button class="btn btn-success" type="submit" onclick=checkRate()>Publish</button>
          </div>
        </form>
        </div>
      </div>
  </div>
  @endif
  <div class="reviews">
      @foreach($reviews as $review)
        @if($review->user_id == Auth::id())
          @continue
        @endif
        <div class="review-card">
          <div class="review-photo">
              <img src="{{$review->avatar}}">
          </div>
          <div class="review-box">
              <div class="review-author">
              <p><strong>{{$review->name}}</strong>&nbsp;&nbsp;- 
                <span class="fa fa-star @if($review->rate > 0 ) checked @else fa-star-o @endif"></span>
                <span class="fa fa-star @if($review->rate > 1 ) checked @else fa-star-o @endif"></span>
                <span class="fa fa-star @if($review->rate > 2 ) checked @else fa-star-o @endif"></span>
                <span class="fa fa-star @if($review->rate > 3 ) checked @else fa-star-o @endif"></span>
                <span class="fa fa-star @if($review->rate > 4 ) checked @else fa-star-o @endif"></span>
              </p>
              </div>
              <div class="review-comment">
                  <p> {{$review->comment}}
                  </p>
              </div>
              
              <div class="review-date">
                  <time>{{$review->created_at}}</time>
              </div>
          </div>
        </div>
      @endforeach
    </div>
    <h2 style="margin:5rem 0 2rem 5rem; font-weight:bold;">Related Books</h2>
    <div class="accordian">
      <ul>
        @if(count($relatedBooks) < 10)
        <div>
        <style>
          .accordian ul:hover li {width: {!! json_encode(1100/(count($relatedBooks)+1)) !!}px;}
          .accordian ul li:hover {width: {!! json_encode(1100/(count($relatedBooks)+1)*2) !!}px;}
          .accordian li {width: {!! json_encode(1100/(count($relatedBooks))) !!}px;}
          .image_title {width: 150%;text-align: left;}
        </style>
        @endif
        @foreach($relatedBooks as $book)
          <li>
            <div class="image_title">
              <a href="{{ route('books.show', $book->id) }}">{{ $book->title }}</a>
            </div>
            <a href="{{ route('books.show', $book->id) }}">
              <img src="{{ $book->cover }}"/>
            </a>
          </li>
        @endforeach
      </ul>
    </div>
    <div id="success_message" class="alert alert-success ajax_response fixed-top m-auto" style="text-align:center;"></div>
  <div id="error_message" class="alert alert-danger ajax_response fixed-top m-auto" style="max-width:320px !important; text-align:center;" ></div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script>
      function handlingFav(book_id, event){
          if(event.target.checked){                
              $.ajax({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  type: 'POST',
                  url: "/favourites",
                  data: { book: book_id },
                  success: function(result) {
                      $('#success_message').fadeIn().html(result);
                      setTimeout(function() {
                          $('#success_message').fadeOut("slow");
                      }, 2000 );
                  },
                  error: function() {
                  }
              })
          }
          else{
              $.ajax({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  type: 'DELETE',
                  url: "{{ route('removeFavourite') }}",
                  data: { book: book_id },
                  success: function(result) {
                      $('#success_message').fadeIn().html(result);
                      setTimeout(function() {
                          $('#success_message').fadeOut("slow");
                      }, 2000 );
                  },
                  error: function() {
                  }
              })
          }
      }

      function createReview(rate, comment, date){
          
        newChild = "<div class='review-card'><div class='review-photo'><img src=" + {!! json_encode(Auth::user()->avatar) !!}
                    + "></div><div id='myReview' class='review-box'>"+
                    "<button id='deleteMyReview' type='button' title='delete' class='close'><i class='fa fa-trash' aria-hidden='true'></i></button>"+
                    // "<button id='review-edit' type='button' class='close'><i class='fa fa-edit' style='font-size:1.15rem !important; margin-right:5px; margin-top:2px;' title='edit'></i></button>"+
                    "<div class='review-author'><p><strong>"
                    + {!! json_encode(Auth::user()->name) !!} + '</strong>\xa0\xa0 - ';
        
        (rate > 0) ? newChild += "<span class='fa fa-star checked '></span>" : newChild += "<span class='fa fa-star fa-star-o'></span>";
        (rate > 1) ? newChild += "<span class='fa fa-star checked '></span>" : newChild += "<span class='fa fa-star fa-star-o'></span>";
        (rate > 2) ? newChild += "<span class='fa fa-star checked '></span>" : newChild += "<span class='fa fa-star fa-star-o'></span>";
        (rate > 3) ? newChild += "<span class='fa fa-star checked '></span>" : newChild += "<span class='fa fa-star fa-star-o'></span>";
        (rate > 4) ? newChild += "<span class='fa fa-star checked '></span>" : newChild += "<span class='fa fa-star fa-star-o'></span>";
        
        newChild += "</p></div><div class='review-comment'><p> " + 
                    comment + "</p></div> <div class='review-date'><time>" +
                    date + "</time></div><style>#myReview{background-color:rgba(255, 240, 0, 0.24);} #myReview:after {border-right-color:rgba(255, 240, 0, 0.24);}</style></div></div>"
        document.querySelector(".reviews").innerHTML = newChild + document.querySelector(".reviews").innerHTML;

        $("#deleteMyReview").click(function(e) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'DELETE',
            url: "{{ route('removeReview') }}",
            data: { 'book_id': {!! json_encode($book->id) !!} },
            success: function(result) {
              location.reload(true);
              },
            error: function(err) {
              console.log(err);
            }
          });
        });
      }

      function checkRate(e){
        rate = $("input[name='rating']:checked").val();
        if(!rate){
          $('#error_message').fadeIn().html("You must choose a rate!");
          setTimeout(function() {
              $('#error_message').fadeOut("slow");
          }, 2000 );
        }
      }

      $("#review-form").submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        rate = $("input[name='rating']:checked").val();
        comment = document.querySelector("textarea[name='comment']").value;
        if(rate <= 0 || rate > 5){
          $('#error_message').fadeIn().html("Stop fooling around!, I'm WATCHING you!!");
          setTimeout(function() {
              $('#error_message').fadeOut("slow");
          }, 2000 );
          return;
        }     
        $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: 'POST',
          url: "{{ route('reviews.store') }}",
          data: { 'book': {!! json_encode($book->id) !!}, 'rate': rate, 'comment': comment },
          success: function(result) {
              $('#success_message').fadeIn().html(result);
              setTimeout(function() {
                  $('#success_message').fadeOut("slow");
              }, 2000 );
              let dt = new Date();
              let stringDate=dateFormating(dt); 
              document.querySelector(".reviewing-box").style.display = "none";
              createReview(rate, comment, stringDate);
            },
          error: function(err) {
            console.log(err);
          }
        });
      });

      function deleteLease(){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'DELETE',
            url: "{{ route('removeLease') }}",
            data: { book_id: {!! json_encode($book->id) !!} },
            success: function(result) {
                if(!{!! json_encode($userReview) !!}){
                  $('#success_message').fadeIn().html(result);
                  setTimeout(function() {
                      $('#success_message').fadeOut("slow");
                  }, 5000 );
                }else{
                  $('#success_message').fadeIn().html("we hope you've enjoyed the book!");
                  setTimeout(function() {
                      $('#success_message').fadeOut("slow");
                  }, 5000 );
                }
                document.querySelector('#book-actions').innerHTML = "<button class='btn btn-success col-5' style='height:3rem'> Lease </button>";
                document.querySelector('#book-quantity').innerHTML = "<h5>@if($book->quantity+1 == 1) {{$book->quantity+1}} copy @else {{$book->quantity+1}} copies @endif available </h5>";
            },
            error: function() {
            }
        })
      }

      $(document).ready(()=>{
        review = {!! json_encode($userReview) !!}; 
        if(review){
          let rate = review.rate;
          let comment = review.comment;
          comment = comment? comment: ""; //handling null values
          let dt = new Date(review.created_at);
          let created_at = dateFormating(dt);
          createReview(rate, comment, created_at);
        }
      });

      function dateFormating(dt){
        return `
${(dt.getFullYear()).toString().padStart(4, '0')}-\
${(dt.getMonth()+1).toString().padStart(2, '0')}-\
${dt.getDate().toString().padStart(2, '0')} \
${dt.getHours().toString().padStart(2, '0')}:\
${dt.getMinutes().toString().padStart(2, '0')}:\
${dt.getSeconds().toString().padStart(2, '0')}`;
      }
  </script>

@endsection
