<?php

namespace App\Http\Controllers;

use App\Models\Series;
use App\Models\SeriesSchedule;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class PlannerController extends Controller
{
    public function dashboard(Request $request): View
    {
        $startOfWeek = Carbon::now()->startOfWeek(2);
        $startOfLastWeek = SeriesSchedule::max('start_date');
        $raceWeeks = CarbonPeriod::create($startOfWeek, '1 week', $startOfLastWeek)->toArray();

        $series = Cache::remember('myracing-dashboard', 900, function () {
            return Series::withCurrentSeasonSchedules(false);
        });

        return view('dashboard', [
            'startOfWeek' => $startOfWeek,
            'raceWeeks' => $raceWeeks,
            'series' => $series,
        ]);
    }

    public function planner(Request $request): View
    {
        $series = Cache::remember('myracing-planner', 900, function () {
            return Series::withCurrentSeasonSchedules();
        });

        return view('planner', [
            'series' => $series,
        ]);
    }
}
