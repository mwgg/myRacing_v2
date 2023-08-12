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
		$schedule->command('queue:work --stop-when-empty')
            ->everyTenMinutes()
            ->withoutOverlapping();

        $schedule->command('update:series')
            ->daily();

        $schedule->command('update:series-season')
            ->daily();

        $schedule->command('update:tracks')
            ->daily();

        $schedule->command('update:cars')
            ->daily();

        $schedule->command('update:car-class')
            ->daily();

        $schedule->command('update:series-assets')
            ->daily();

        $schedule->command('update:track-assets')
            ->daily();
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
