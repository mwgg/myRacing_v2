<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use DateTimeZone;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('update:series')
            ->dailyAt('0:00');

        $schedule->command('update:series-season')
            ->dailyAt('0:01');

        $schedule->command('update:tracks')
            ->dailyAt('0:02');

        $schedule->command('update:cars')
            ->dailyAt('0:03');

        $schedule->command('update:car-class')
            ->dailyAt('0:04');

        $schedule->command('update:series-assets')
            ->dailyAt('0:05');

        $schedule->command('update:track-assets')
            ->dailyAt('0:06');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

    /**
     * Get the timezone that should be used by default for scheduled events.
     */
    protected function scheduleTimezone(): DateTimeZone|string|null
    {
        return 'UTC';
    }
}
