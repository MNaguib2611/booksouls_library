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
                            @if(Auth::user()->isAdmin == 1)
                            <a class="nav-link js-scroll-trigger" href="{{ url('/home') }}">Dashboard</a>
                            @else
                            <a class="nav-link js-scroll-trigger" href="{{ url('/books') }}">Our Books</a>
                            @endif
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
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#about">About Us</a>
                </li>
                @auth
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="/logout"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
                @endauth
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
                <h4 class="service-heading">Leases</h4>
                <p class="text-muted">Here you can borrow any books any time, but you have maximum of 1 book per month.</p>
                </div>
                <div class="col-md-4">
                <h4 class="service-heading">Academic & Research Support</h4>
                <p class="text-muted">You can also turn to the public library if you or someone else in your family needs help on a school project or research paper.</p>
                </div>
                <div class="col-md-4">
                <h4 class="service-heading">Digital Entertainment</h4>
                <p class="text-muted">You can also check out CDs, DVDs, audiobooks, and video games from most public libraries.</p>
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
                    <img class="mx-auto rounded-circle" src="{{asset('imgs/OmarMahmoud.jpg')}}" alt="">
                    <h4>Omar Abdo</h4>
                    <p class="text-muted">Super Developer</p>
                </div>
                </div>
                <div class="col-sm-3">
                <div class="team-member">
                    <img class="mx-auto rounded-circle" src="{{asset('imgs/shafeey.jpeg')}}" alt="">
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
                    <img class="mx-auto rounded-circle" src="{{asset('imgs/reham.jpeg')}}" alt="">
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

        <!-- About -->
        <section class="page-section" id="about">
            <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                <h2 class="section-heading text-uppercase">About Us</h2>:
                <h3 class="section-subheading text-muted">We inspire and enable independent minds, providing resources, spaces and technologies.</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                <ul class="timeline">
                    <li>
                    <div class="timeline-image">
                    <h4>Who
                    <br>Are
                    <br>We</h4>
                    </div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                        <h4> ITIans Students</h4>
                        </div>
                        <div class="timeline-body">
                        <p class="text-muted">Information Technology Institution (ITI)</p>
                        <p class="text-muted">Intake 40 - 2019:2020 </p>
                        <p class="text-muted">Web Application Development </p>
                        </div>
                    </div>
                    </li>
                    <li class="timeline-inverted">
                    <div class="timeline-image">
                    <h4><br/>Tools</h4>
                    </div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                        <h4></h4>
                        </div>
                        <div class="timeline-body">
                        <p class="text-muted">
                        <img src="https://qph.fs.quoracdn.net/main-qimg-f08bb4707cd8c12929d77a1ba09a85d5" width=40% height=40%>
                        <br/>
                        <img src="data:image/png;base64,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" width=30% height=40%>
                        </p>
                        </div>
                    </div>
                    </li>
                   
                </ul>
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
                    <a href="#about">About US</a>
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
    <script type="text/javascript" src="{{asset('js/agency.min.js')}}"></script>
    </body>
</html>
