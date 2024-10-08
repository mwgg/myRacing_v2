<?php

namespace App\Jobs;

use App\Models\Series;
use iRacingPHP\iRacing;

class UpdateSeriesAssetsJob extends UpdateDataJob
{
    public function handle(iRacing $iracing): void
    {
        $assets = $iracing->series->assets();

        foreach ($assets as $asset) {
            $series = Series::where('series_id', $asset->series_id)->first();
            if (!$series) continue;

            $series->logo_url = 'https://images-static.iracing.com/img/logos/series/' . $asset->logo;
            $series->save();
        }
    }
}
