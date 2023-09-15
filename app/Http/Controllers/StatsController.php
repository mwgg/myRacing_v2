<?php

namespace App\Http\Controllers;

use App\iRacing\Constants;
use App\Models\Series;
use App\Models\Track;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function stats(Request $request)
    {
        $series = Series::with('currentSeason', 'currentSeason.schedules', 'currentSeason.schedules.track')
            ->whereHas('currentSeason', function($query) {
                $query->where('license_group', '>=', 2)
                ->whereHas('schedules', function($query) {
                    $query->where('start_date', '>=', Carbon::now()->startOfDay());
                });
            })
            ->get();

        $trackCounts = [];
        $usedTrackPackageIds = [];

        // most common tracks
        foreach($series as $s) {
            foreach($s->currentSeason->schedules as $schedule) {
                if(!isset($trackCounts[$s->category_id][$schedule->track->name])) $trackCounts[$s->category_id][$schedule->track->name] = 0;
                $trackCounts[$s->category_id][$schedule->track->name]++;
                $usedTrackPackageIds[] = $schedule->track->package_id;
            }
        }

        foreach(array_keys(Constants::CATEGORIES) as $categoryId) {
            arsort($trackCounts[$categoryId]);
        }

        // unused tracks
        $unusedTracks = Track::whereNotIn('package_id', $usedTrackPackageIds)
            ->where('name', 'not like', '%[Retired]%')
            ->orderBy('name')
            ->pluck('name')
            ->toArray();

        $unusedTracks = array_unique($unusedTracks);
        sort($unusedTracks);

        return view('stats', [
            'trackCounts' => $trackCounts,
            'unusedTracks' => $unusedTracks,
        ]);
    }
}
