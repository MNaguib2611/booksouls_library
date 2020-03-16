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
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#team">Our Team</a>
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
          <h3 class="section-subheading text-muted">Always at your help</h3>
        </div>
        <div class="row text-center">
        <div class="col-md-4">
          <h4 class="service-heading">Digital Entertainment</h4>
          <p class="text-muted">You can also check out CDs, DVDs, audiobooks, and video games from most public libraries.</p>
        </div>
        <div class="col-md-4">
          <h4 class="service-heading">Leases</h4>
          <p class="text-muted">Here you can borrow any books any time, but you have maximum of 1 month per book.</p>
        </div>
        <div class="col-md-4">
          <h4 class="service-heading">Academic & Research Support</h4>
          <p class="text-muted">You can also turn to the public library if you or someone else in your family needs help on a school project or research paper.</p>
        </div>
      </div>
      </div>
  </section>

  <!-- Team -->
  <section class="bg-light page-section" id="team">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">Our Amazing Team</h2>
          <h3 class="section-subheading text-muted">Awesome Developers</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-3">
          <div class="team-member">
            <img class="mx-auto rounded-circle" src="{{asset('imgs/omar.jpeg')}}" alt="">
            <h4>Omar Abdo</h4>
            <p class="text-muted">Super Developer</p>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="team-member">
            <img class="mx-auto rounded-circle" src="{{asset('imgs/shefo.jpeg')}}" alt="">
            <h4>Mohamed Shafeay</h4>
            <p class="text-muted">Software Developer</p>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="team-member">
            <img class="mx-auto rounded-circle" src="{{asset('imgs/pp.jpeg')}}" alt="">
            <h4>Mohamed Nagieb</h4>
            <p class="text-muted">Software Developer</p>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="team-member">
            <img class="mx-auto rounded-circle" src="{{asset('imgs/header-bg.jpg')}}" alt="">
            <h4>Reham Hussien</h4>
            <p class="text-muted">Software Developer</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-8 mx-auto text-center">
          <p class="large text-muted">This Team Work 24 hours daily for your pleasure</p>
        </div>
      </div>
    </div>
  </section>


  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-4">
          <span class="copyright">Copyright &copy; Book Souls 2020</span>
        </div>
        <div class="col-md-4">
          
        </div>
        <div class="col-md-4">
          <ul class="list-inline quicklinks">
            <li class="list-inline-item">
              <a href="#">Privacy Policy</a>
            </li>
            <li class="list-inline-item">
              <a href="#">Terms of Use</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

  <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/jquery.easing.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/app.js')}}"></script>

  <script type="text/javascript" src="{{asset('js/agency.min.js')}}"></script>
    </body>
</html>
