<?php

namespace App\Jobs;

use App\Models\Track;

class UpdateTracks extends UpdateData
{
    public function handle(): void
    {
        $tracks = $this->iracing->track->get();

        foreach($tracks as $t)
        {
            $track = Track::firstOrCreate(
                [
                    'track_id' => $t->track_id
                ],
                [
                    'category_id' => $t->track_id,
                    'free' => $t->free_with_subscription,
                    'location' => $t->location,
                    'package_id' => $t->package_id,
                    'track_id' => $t->track_id,
                    'price' => $t->price,
                    'sku' => $t->sku,
                    'name' => $t->track_name,
                    'config_name' => $t->config_name ?? null,
                ]
            );
        }
    }
}
