<?php

namespace App\Console\Commands;

use App\Jobs\UpdateTracksJob;
use Illuminate\Console\Command;

class UpdateTracks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:tracks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update iRacing tracks';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        UpdateTracksJob::dispatch();

        return Command::SUCCESS;
    }
}
