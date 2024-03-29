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
        Commands\AddQueueCron::class,
        Commands\OldBackupsDeleteCron::class,
        Commands\AddqueueDatabaseBasedCron::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('addqueue:cron')->dailyAt('05:00');
        $schedule->command('oldbackupdelete:cron')->dailyAt('03:00');

        //$schedule->command('AddqueueDatabaseBased:cron')->hourly(); //Open is if you want to get hourly database backup
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
