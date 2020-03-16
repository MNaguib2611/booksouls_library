<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Agency - BookSoulsLibrary</title>

        <!-- Bootstrap core CSS -->
         <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Custom fonts for this template -->
        <link href="{{asset('css/all.min.css')}}" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
        <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

        <!-- Custom styles for this template -->
          <!-- <link href="css/agency.min.css" rel="stylesheet"> -->
        <link href="{{asset('css/agency.min.css')}}" rel="stylesheet">
       
    </head>
    <body  id="page-top">
         <!-- Navigation -->
            <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
                <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="#page-top">Bouk Souls</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ml-auto">
                    @if (Route::has('login'))
                        <li class="nav-item">
                            @auth
                            <a class="nav-link js-scroll-trigger" href="{{ url('/home') }}">Home</a>
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
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#services">Services</a>
                    </li>
                    </ul>
                </div>
                </div>
            </nav>

          <!-- Header -->
            <header class="masthead" style="background-image: url({{asset('imgs/header-bg.jpg')}});">
                <div class="container">
                <div class="intro-text">
                    <div class="intro-lead-in">Welcome To Our Library!</div>
                    <div class="intro-heading text-uppercase">It's Nice To Meet You</div>
                    <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#services">Tell Me More</a>
                </div>
                </div>
            </header>

            <!-- Services -->
  <section class="page-section" id="services">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">Services</h2>
          <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
        </div>
      </div>
  </section>

    </body>
</html>
