<?php

namespace App\Jobs;

use App\Models\Series;

class UpdateSeriesJob extends UpdateDataJob
{
    public function handle(): void
    {
        $series = $this->iracing->series->get();

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
