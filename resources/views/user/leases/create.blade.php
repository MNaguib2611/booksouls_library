<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Lease A Book</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600|Raleway:300,400,600&amp;subset=latin-ext'>
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css'>
<link rel="stylesheet" href="{{asset('/css/lease.css')}}">
<link rel='stylesheet' href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css'>
<link rel="stylesheet" href="{{asset('/css/sliderDays.css')}}">

</head>
<body>
<script>
    const price={!! $book->price !!};
</script>
<div class="container-fluid background">
    <div class="row padding-top-20 ">
        <div class="mt-5 col-12 col-sm-12 col-md-10 col-lg-10 col-xl-8 offset-md-1 offset-lg-1 offset-xl-2">
            <div class="row">
                <div class="col-12 main-wrapper">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div id="template" class="row panel-wrapper">
                                <div class="col-12 panel-header basket-header">
                                    <div class="row">
                                        <div class="col-6 basket-title">
                                            <span class="description">review your</span><br><span class="emphasized">Book Lease</span>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div 
                                    class="col-12 panel-body basket-body" 
                                    style="height:350px !important;padding:0 !important">
                                    <img src="{{$book->cover}}" width="100%" height="100%">
                                </div>
                                <div class="col-12 panel-footer basket-footer">
                                    <div class="row mt-3">
                                        <div class="col-11 align-center description">
                                            <div class="dive emphasized">
                                                <h2>{{$book->title}}</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="row panel-wrapper">
                                <div class="col-12 panel-header creditcard-header">
                                    <div class="row">
                                        <div class="col-12 creditcard-title">
                                            <span class="description">please enter your</span><br><span class="emphasized">Lease Period</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 panel-body creditcard-body">
                                            <small>Please note you can't lease more than 5 books at a time.</small><br>
                                            <small>You can Return the book after at least 1 day.</small><br>
                                            <small>You can't rent 2 copies of the same book.</small>
                                            
                                            <section id="content">
                                                @if ($errors->any())
                                                <div class="alert alert-danger text-left">
                                                        @foreach ($errors->all() as $error)
                                                            <small>{{ $error }}</small><br>
                                                        @endforeach
                                                </div>
                                                @endif
                                                <input disabled type="text" id="days" value="5 Days" />
                                                <div class="cube">
                                                  <div class="a"></div>
                                                  <div class="b"></div>
                                                  <div class="c"></div>
                                                  <div class="d"></div>
                                                  <div id="slider-range-min"></div>
                                                </div>
                                                <input disabled type="text" id="amount"  value="$10"/>
                                              </section>
                                </div>
                                <div class="col-12 panel-footer creditcard-footer">
                                    <div class="row">
                                        <div class="col-12 align-right">
                                            <a
                                            href="{{route('books.index')}}"
                                             class="cancel btn">Cancel</a>
                                            &nbsp;
                                            <form class="d-inline" action="{{route('leases.store')}}" method="post">
                                                @csrf
                                                <input id="daysForm" type="hidden" name="days" value="5">
                                                <input id="bookId" type="hidden" name="book" value="{{$book->id}}">
                                                <button type="submit" class="confirm">Confirm</button></div>
                                            </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- partial -->
  <script src='https://code.jquery.com/jquery-3.2.1.slim.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/mustache.js/2.3.0/mustache.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js'></script><script  src="./script.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>
<script  src="{{asset('/js/lease.js')}}"></script>

</body>
</html>
