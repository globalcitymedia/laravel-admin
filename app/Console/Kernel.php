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
        '\App\Console\Commands\DispatchTasks',
        '\App\Console\Commands\EmailNewsUpdates',
        '\App\Console\Commands\EmailStatsUpdate',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        $schedule->command('outbox:send-news-updates')->withoutOverlapping()->everyMinute();
        $schedule->command('scheduletask:dispatch-tasks')->withoutOverlapping()->everyFifteenMinutes();
        $schedule->command('email-stats-update')->withoutOverlapping()->everyThirtyMinutes();
        $schedule->command('outbox:empty-sent-mails')->withoutOverlapping()->everyFifteenMinutes()->between('8:00', '23:00');

        $schedule->exec('php artisane log:clear');
        //echo "Hello";
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
