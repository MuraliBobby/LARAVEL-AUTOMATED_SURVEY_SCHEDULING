<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\IncrementTime;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
<<<<<<< HEAD
        $schedule->command('survey:send')->everyTwoMinutes();
        
        $schedule->command(IncrementTime::class)->everyMinute();
=======
        $schedule->command(SendSurveyCommand::class)->everyMinute();
>>>>>>> 65b2c34a98980085731b3729601ff04ea78bf1f5
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

   
}
