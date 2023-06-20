<?php

namespace App\Http\Controllers;

use App\Models\Series;
use App\Models\SeriesSchedule;
use App\Models\SeriesSeason;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class PlannerController extends Controller
{
    public function dashboard(Request $request)
    {
        $startOfWeek = Carbon::now()->startOfWeek(2);
        $endOfWeek = $startOfWeek->copy()->addWeek();
        $startOfLastWeek = SeriesSchedule::max('start_date');
        $raceWeeks = CarbonPeriod::create($startOfWeek, '1 week', $startOfLastWeek)->toArray();

        $series = Series::withUpcomingSchedules();

        return view('dashboard', [
            'startOfWeek' => $startOfWeek,
            'endOfWeek' => $endOfWeek,
            'startOfLastWeek' => $startOfLastWeek,
            'raceWeeks' => $raceWeeks,
            'series' => $series,
        ]);
    }

    public function planner(Request $request)
    {
        $series = Series::withUpcomingSchedules();

        return view('planner', [
            'series' => $series,
        ]);
    }
}
