<?php

namespace App\Console\Commands;

use App\Jobs\UpdateSeriesAssetsJob;
use Illuminate\Console\Command;

class UpdateSeriesAssets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:series-assets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update iRacing series assets';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        UpdateSeriesAssetsJob::dispatch();
    }
}
