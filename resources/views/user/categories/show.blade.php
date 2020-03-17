@extends('layouts.app')

{{ HTML::style('css/likebutton.css') }}
{{ HTML::style('css/bookcard.css') }}
{{ HTML::style('css/rating.css') }}
{{ HTML::style('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css') }}

@section('content')
    @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
            </div>
    @endif
    <h1>{{$category->name}}</h1>
    <div class="cards">
        @foreach ($books as $book)
        <div class="book-card">
            <div class="book-card-body">
                <div class="card__inner" style="background: url({{$book->cover}}) no-repeat;">
                    <h2>{{$book->title}}</h2>
                    <div class="card__buttons">
                        <a href="{{ route('books.show', $book->id) }}">More Details</a>
                        <a href="{{ route('books.show', $book->id) }}" class="@if ($book->quantity == 0) disabled @endif">Lease</a>
                    </div>
                </div>
                <div class="card-bdy">
                    <h3 class="card-text ml-3"> <strong>by</strong> <strong class="text-primary">{{$book->author}}</strong></h3>
                    <h3 class="card-text m-3">{{$book->description}}</h3>
                </div>
            </div>

            <div class="book-card-footer">
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
                <div class="rating rating-card mb-2"> 
                    <span class="fa fa-star @if($book->rate > 4 )@if($book->rate == 4.5)fa-star-half-o @endif checked @else fa-star-o @endif"></span>
                    <span class="fa fa-star @if($book->rate > 3 )@if($book->rate == 3.5)fa-star-half-o @endif checked @else fa-star-o @endif"></span>
                    <span class="fa fa-star @if($book->rate > 2 )@if($book->rate == 2.5)fa-star-half-o @endif checked @else fa-star-o @endif"></span>
                    <span class="fa fa-star @if($book->rate > 1 )@if($book->rate == 1.5)fa-star-half-o @endif checked @else fa-star-o @endif"></span>
                    <span class="fa fa-star @if($book->rate > 0 )@if($book->rate == 0.5)fa-star-half-o @endif checked @else fa-star-o @endif"></span>
                </div>
                <div class="price">
                    <span class="currency">$</span>
                    <span class="value">{{$book->price}}</span>
                    <span class="duration">day</span>
                </div>
                <div class="copies text-muted">
                    <h5>@if($book->quantity == 1) {{$book->quantity}} copy available @elseif($book->quantity == 0) <div class="alert alert-danger nocopies">No copies available </div> @else {{$book->quantity}} copies available @endif</h5>
                </div>
            </div>
        </div>
        @endforeach
        <div id="success_message" class="alert alert-success ajax_response fixed-top m-auto" ></div>
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
        </script>
    </div>
    <div class="paginate">
        {{$books->links()}}
    </div>
@endsection
