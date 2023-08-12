<?php

namespace App\Jobs;

use App\Models\Series;
use iRacingPHP\iRacing;

class UpdateSeriesJob extends UpdateDataJob
{
    public function handle(iRacing $iracing): void
    {
        $series = $iracing->series->get();

        foreach($series as $s)
        {
            $serie = Series::updateOrCreate(
                [
                    'series_id' => $s->series_id
                ],
                [
                    'series_id' => $s->series_id,
                    'series_name' => $s->series_name,
                    'category_id' => $s->category_id,
                    'forum_url' => $s->forum_url ?? null,
                ]
            );
        }
    }
}
