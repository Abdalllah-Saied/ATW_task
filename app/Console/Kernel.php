<?php

namespace App\Console;

use App\Jobs\ForceDeleteSoftDeletedPosts;
use App\Jobs\MakeHttpRequestAndLogResponse;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->job(new ForceDeleteSoftDeletedPosts)->daily();
        $schedule->job(new MakeHttpRequestAndLogResponse)->everySixHours();

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
