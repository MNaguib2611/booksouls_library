@extends('layouts.app')
@section('content')
<script>
const profitDates={!! $profitDates !!};
const profitvalues={!! $profitvalues !!};


const booksCategory={!! $booksCategory !!};
const booksCountBCategory={!! $booksCountBCategory !!};


const leasesCategory={!! $leasesCategory !!};
const leaseCountBCategory={!! $leaseCountBCategory !!};
</script>
<div class="m-auto col-lg-10">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <ul>
                        <li><a href="{{route('admins.index')}}">Admins</a></li>
                        <li><a href="{{route('users.index')}}">Users</a></li>
                        <li><a href="{{route('books.index')}}">Books</a></li>
                        <li><a href="{{route('categories.index')}}">Categories</a></li>

                    </ul>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <h1>Profits</h1>
                            <canvas id="myProfit"></canvas>

                        </div>
                        <div class="col-6 mb-3">
                            <h1>Book Leases</h1>
                        <canvas id="Rents" ></canvas>

                        </div>
                        <div class="col-6 mb-3 ">
                            <h1>Available Books</h1>
                        <canvas id="Books" ></canvas>

                        </div>
                        
                        
                        
                        
                        <div class="col-6 mt-5 text-center">
                            <h3>Total number of Leases:{{$leases}}</h3>
                            <h3>Total number of Books:{{$Books}}</h3>
                            <h3>Total number of Users:{{$users}}</h3>
                            <h3>Total number of Admins:{{$Admins}}</h3>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('js')
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>
<script src="{{asset('/js/dashboard.js')}}"></script>
@endsection

@endsection
