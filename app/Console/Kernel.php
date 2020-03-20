<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Carbon\Carbon;
use App\Lease;
use App\Profit;
use App\Book;
use DB;

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

        # to calculate the profits of the past day
        $schedule->call(function () {
            $profits = 0;
            $leasesOfTheMonth = Lease::onlyTrashed()->whereDate('deleted_at', '>=', Carbon::now()->subDays(30))->get();
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
        })->monthlyOn(1, '22:00');   ## 12 AM in our timezone


        # to return the leased books when the period is over
        $schedule->call(function () {
            Lease::where('duration', '<', DB::raw('DATEDIFF(now(), created_at)'))->delete();
        })->dailyAt('22:00');


        ##### now our tasks have been scheduled successfully all we need is just run ```php artisan schedule:run```
        ##### everyday at the morning or the midnight and it will do the job
        ##### but of course we won't do that because there is something called AUTOMATION
        ##### so now let do this, we need to edit the crobjob file so it can do it on our behalf

        ##### { crontab -e } is the command that you need to run to open the cronjob file
        ##### and then you just need to add the below line at the end of the file
        ##        00 00 * * * cd [the-path-to-the-project-directory] && php artisan schedule:run >> /dev/null 2>&1         ##
        ##### and make sure to replace "[the-path-to-the-project-directory]" with your own path
        
        ##### this will make it automatically run the command ```php artisan schedule:run``` periodically
        ##### and the (00 00 * * *) at the start of the line represents the period, 5 places for (minute hour day[month] week day[week])
        ##### for more details about cron jobs you can check out this website https://crontab.guru
        

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
