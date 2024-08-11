<?php

namespace App\Console\Commands;

use App\Jobs\UpdateTrackAssetsJob;
use Illuminate\Console\Command;

class UpdateTrackAssets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:track-assets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update iRacing track assets';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        UpdateTrackAssetsJob::dispatch();

        return Command::SUCCESS;
    }
}
