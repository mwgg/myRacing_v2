<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use iRacingPHP\iRacing;

class UpdateData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected iRacing $iracing;

    function __construct()
    {
        $this->iracing = new iRacing(env('IRACING_USERNAME'), env('IRACING_PASSWORD'));
    }
}
