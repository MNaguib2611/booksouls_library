<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $profits = 0;
            $leasesOfTheMonth = Lease::onlyTrashed()->whereDate('created_at', '>', Carbon::now()->subDays(1))->get();
            foreach ($leasesOfTheMonth as $lease) {
                $date1 = strtotime($lease->created_at); 
                $date2 = strtotime($lease->deleted_at);

                $period = floor(($date2 - $date1)/60/60/24);
                $price = Book::withTrashed()->find($lease->book_id)->price;
                $profit = $period * $price;
                $profits += $profit;
            }
            error_log($profits);
            $monthlyProfit = new Profit;
            $monthlyProfit->profit = $profits;
            $monthlyProfit->save();
        })->dailyAt('00:00');

        #####  ->monthlyOn(1, '00:00'); #to run on day 1 of each month at 12 am
        ##### this would be the case for production but since where are still in the development we will make it daily
        ##### same as for subDays() in line 33:99, it would take 30 in production to get the results of the last month
        ##### but to make our tests and imagine the whole picture we made it daily
        ##### { crontab -e } is the command that you need to run to open the file to edit 
        ##### the server settings and make the check for tasks periodic
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
