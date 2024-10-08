<?php

namespace App\Console\Commands;

use App\Jobs\UpdateCarClassJob;
use Illuminate\Console\Command;

class UpdateCarClass extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:car-class';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update iRacing car classes';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        UpdateCarClassJob::dispatch();

        return Command::SUCCESS;
    }
}
