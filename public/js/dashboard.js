   var ctx = document.getElementById('myProfit').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: profitDates,
            datasets: [{
                label: 'Profit',
                data: profitvalues,
                backgroundColor: [
                    'rgba(10, 255, 149, 0.57)' ,
                ],
                borderWidth: 1
            }]
        },
       
        options: {
            animation: {
                duration : 4000
            },
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
            labels: leasesCategory,
            datasets: [{
                label: 'Rents',
                data: leaseCountBCategory,
                backgroundColor: [
                    '#003f5c',
                    '#2f4b7c',
                    '#665191',
                    '#a05195',
                    '#d45087',
                    '#f95d6a',
                    '#ff7c43',
                    '#ffa600',
                    '#6dcff6',
                    '#8dc63f',
                    '#ce1126',

                ],
                borderWidth: 1
            }]
        },
       
       
        options: {
            animation: {
                duration : 2000
            },
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
            labels: booksCategory,
            datasets: [{
                label: 'Books',
                data: booksCountBCategory,
                backgroundColor: [
                    '#6dcff6',
                    '#8dc63f',
                    '#ce1126',
                    "rgba(255, 0, 0, 0.57)",
                    'rgba(255, 196, 62, 0.57)',
                    'rgba(255, 0, 238, 0.57)',
                    'rgba(0, 34, 255, 0.57)' ,
                    'rgba(0, 255, 119, 0.57)' ,
                    'rgba(0, 255, 229, 0.57)'
                ],
                borderWidth: 1
            }]
        },
       
        
            options: {
                animation: {
                    duration : 7000
                },
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
