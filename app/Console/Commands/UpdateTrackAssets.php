<?php

namespace App\Console\Commands;

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
    public function handle()
    {
        $job = new \App\Jobs\UpdateTrackAssets();
        $job->handle();
    }
}
