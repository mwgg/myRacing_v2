<?php

namespace App\Console\Commands;

use App\Jobs\UpdateSeriesJob;
use Illuminate\Console\Command;

class UpdateSeries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:series';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update iRacing series data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        UpdateSeriesJob::dispatch();
    }
}
