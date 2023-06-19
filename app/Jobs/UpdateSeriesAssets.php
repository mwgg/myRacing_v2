<?php

namespace App\Jobs;

use App\Models\Series;

class UpdateSeriesAssets extends UpdateData
{
    public function handle(): void
    {
        $assets = $this->iracing->series->assets();

        foreach($assets as $asset)
        {
            $series = Series::where('series_id', $asset->series_id)->first();
            if(!$series) continue;

            $series->logo_url = 'https://images-static.iracing.com/img/logos/series/' . $asset->logo;
            $series->save();
        }
    }
}
