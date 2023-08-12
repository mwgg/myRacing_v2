<?php

namespace App\Jobs;

use App\Models\Track;
use iRacingPHP\iRacing;

class UpdateTrackAssetsJob extends UpdateDataJob
{
    public function handle(iRacing $iracing): void
    {
        $assets = $iracing->track->assets();

        foreach($assets as $asset)
        {
            $track = Track::where('track_id', $asset->track_id)->first();
            if(!$track) continue;

            $track->image_url = 'https://images-static.iracing.com' . $asset->folder . '/' . $asset->small_image;
            $track->logo_url = 'https://images-static.iracing.com' . $asset->logo;
            $track->map_url = $asset->track_map . $asset->track_map_layers->active;
            $track->save();
        }
    }
}
