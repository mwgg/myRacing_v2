<?php

namespace App\Http\Controllers;

use App\iRacing\Constants;
use App\Models\Series;
use App\Models\SeriesSchedule;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function stats(Request $request)
    {
        $series = Series::with('currentSeason', 'currentSeason.schedules', 'currentSeason.schedules.track')
        ->whereHas('currentSeason')
        ->get();

        $trackCounts = [];

        foreach($series as $s) {
            foreach($s->currentSeason->schedules as $schedule) {
                if(!isset($trackCounts[$s->category_id][$schedule->track->name])) $trackCounts[$s->category_id][$schedule->track->name] = 0;
                $trackCounts[$s->category_id][$schedule->track->name]++;
            }
        }

        foreach(array_keys(Constants::CATEGORIES) as $categoryId) {
            arsort($trackCounts[$categoryId]);
        }

        return view('stats', [
            'trackCounts' => $trackCounts,
        ]);
    }
}
