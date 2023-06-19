<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('update:series')
            ->timezone('UTC')
            ->daily()
            ->at('0:00');

        $schedule->command('update:series-season')
            ->timezone('UTC')
            ->daily()
            ->at('0:05');

        $schedule->command('update:series-assets')
            ->timezone('UTC')
            ->daily()
            ->at('0:10');

        $schedule->command('update:tracks')
            ->timezone('UTC')
            ->daily()
            ->at('0:15');

        $schedule->command('update:track-assets')
            ->timezone('UTC')
            ->daily()
            ->at('0:20');

        $schedule->command('update:cars')
            ->timezone('UTC')
            ->daily()
            ->at('0:25');
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
