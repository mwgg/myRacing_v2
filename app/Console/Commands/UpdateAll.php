<?php

namespace App\Console\Commands;

use App\Jobs\UpdateCarClassJob;
use App\Jobs\UpdateCarsJob;
use App\Jobs\UpdateSeriesAssetsJob;
use App\Jobs\UpdateSeriesJob;
use App\Jobs\UpdateSeriesSeasonJob;
use App\Jobs\UpdateTrackAssetsJob;
use App\Jobs\UpdateTracksJob;
use Illuminate\Console\Command;

class UpdateAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update all iRacing data';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        UpdateCarClassJob::dispatch();
        UpdateCarsJob::dispatch();
        UpdateSeriesJob::dispatch();
        UpdateSeriesSeasonJob::dispatch();
        UpdateTracksJob::dispatch();
        UpdateTrackAssetsJob::dispatch();
        UpdateSeriesAssetsJob::dispatch();

        return Command::SUCCESS;
    }
}
