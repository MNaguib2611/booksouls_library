<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @yield('title')
   
   

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    @yield('css')

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">


</head>
<body>
    <div id="app">
            <nav class="navbar navbar-expand-lg bg-dark fixed-top" id="mainNav">
                <div class="book__icon">
                    <div class="book__page"></div>
                    <div class="book__page"></div>
                    <div class="book__page"></div>
                </div>
                <a class="navbar-brand js-scroll-trigger" href="#page-top">Bouk Souls</a>
                <button class="navbar-toggler navbar-toggler-right" style="max-height:40px; padding:0 10px;" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span style="margin-top:-1rem !important;">Menu
                    <img src="{{ asset('imgs/menu_icon.png') }}" alt="menu" width="40px" height="40px"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ml-auto">
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="{{ url('/books') }}">Books</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="/leases">My Books</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="/favourites">Favourites</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="/categories">Categories</a>
                    </li>
                    @if (Route::has('login'))
                    <li class="nav-item">
                        @auth
                            <a class="nav-link js-scroll-trigger" href="{{ url('/profile') }}">Profile</a>
                        </li>
                            <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="/logout"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            @else
                            <a class="nav-link js-scroll-trigger" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            @if (Route::has('register'))
                            <a class="nav-link js-scroll-trigger" href="{{ route('register') }}">Register</a>
                            @endif
                        </li>
                        @endauth
                    @endif
                </ul>
                </div>
                </div>
            </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @yield('js')
</body>
</html>
