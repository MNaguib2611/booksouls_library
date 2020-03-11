@extends('layouts.app')

@section('content')
<div class="container">
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
                        <canvas id="myProfit" class="col-6"></canvas>
                        <canvas id="Rents" class="col-6"></canvas>
                        <canvas id="Books" class="col-6"></canvas>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>
<script>
   var ctx = document.getElementById('myProfit').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: 'Profit',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(0, 34, 255, 0.57)'
                ],
                borderWidth: 1
            }]
        },
        animation: {
                duration : 3000
            },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    var ctx = document.getElementById('Rents').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: 'Rents',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(0, 34, 255, 0.57)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderWidth: 1
            }]
        },
       
        animation: {
                duration : 3000
            },
        options: {
            legend: {
        display: false
        },
      
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    },
                    gridLines: {
                        color: "rgba(0, 0, 0, 0)",
                    }
                }],
                
            }
        }
    });

     var ctx = document.getElementById('Books').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: 'Rents',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(0, 34, 255, 0.57)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderWidth: 1
            }]
        },
       
        animation: {
                duration : 3000
            },
            options: {
            legend: {
        display: false
        },
      
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                    // ,
                    // gridLines: {
                    //     color: "rgba(0, 0, 0, 0)",
                    // }
                }],
            //     xAxes: [{
            //     gridLines: {
            //     color: "rgba(0, 0, 0, 0)",
            //     }
            // }],
            }
        }
    });

    </script>
@endsection
