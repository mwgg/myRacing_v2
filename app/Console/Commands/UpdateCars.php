<?php

namespace App\Console\Commands;

use App\Jobs\UpdateCarsJob;
use Illuminate\Console\Command;

class UpdateCars extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:cars';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update iRacing cars';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        UpdateCarsJob::dispatch();

        return Command::SUCCESS;
    }
}
