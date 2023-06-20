<?php

namespace App\Models;

use App\iRacing\Constants;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    use HasFactory;

    protected $fillable = [
        'series_id',
        'series_name',
        'category_id',
        'forum_url',
        'logo_url',
    ];

    public function seasons()
    {
        return $this->hasMany(SeriesSeason::class, 'series_id', 'series_id');
    }

    public function currentSeason()
    {
        return $this->seasons()->one()->ofMany('season_id', 'max');
    }

    public function schedules()
    {
        return $this->hasMany(SeriesSchedule::class, 'series_id', 'series_id');
    }

    public static function withUpcomingSchedules()
    {
        $startOfWeek = Carbon::now()->startOfWeek(2);

        return Series::with('currentSeason', 'schedules', 'schedules.track')
            ->whereHas('schedules', function($query) use($startOfWeek) {
                $query->where('start_date', '>=', $startOfWeek);
            })
            ->orderBy('category_id')
            ->orderBy('series_name')
            ->get()
            ->groupBy('category_id');
    }

    public function tooltipText()
    {
        $line2 = [];
        $line2[] = Constants::LIC_NAMES[$this->currentSeason->license_group];
        if($this->currentSeason->is_heat_racing) $line2[] = 'Heat racing';
        $line2[] = $this->currentSeason->formatSetupType();
        $line2[] = $this->currentSeason->formatOfficialStatus();

        $lines = [$this->series_name];
        $lines[] = implode(', ', $line2);
        $lines[] = $this->currentSeason->schedule_description;

        return implode('<br>', $lines);
    }
}
