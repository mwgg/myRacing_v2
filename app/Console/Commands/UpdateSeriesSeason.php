<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateSeriesSeason extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:series-season';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update iRacing series seasons data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $job = new \App\Jobs\UpdateSeriesSeason();
        $job->handle();
    }
}
