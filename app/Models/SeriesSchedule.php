<?php

namespace App\Models;

use Carbon\Carbon;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeriesSchedule extends Model
{
    use HasFactory, Cachable;

    protected $fillable = [
        'unique_id',
        'season_id',
        'race_week_num',
        'series_id',
        'start_date',
        'race_lap_limit',
        'race_time_limit',
        'start_type',
        'restart_type',
        'qual_attached',
        'full_course_cautions',
        'start_zone',
        'track_id',
    ];

    protected $casts = [
        'start_date' => 'datetime:Y-m-d H:i:s',
    ];

    public function getWeekNumberAttribute() {
        return $this->race_week_num + 1;
    }

    public function series()
    {
        return $this->belongsTo(Series::class, 'series_id', 'series_id');
    }

    public function track()
    {
        return $this->hasOne(Track::class, 'track_id', 'track_id');
    }

    public function isCurrentWeek()
    {
        return $this->start_date->between(Carbon::now()->startOfWeek(2), Carbon::now()->addDays(6)->endOfDay());
    }

    public function isPastWeek()
    {
        return $this->start_date < Carbon::now()->startOfWeek(2);
    }

    public function formatStartType()
    {
        return $this->start_type . ' start';
    }

    public function formatRaceLength()
    {
        if($this->race_lap_limit) return $this->race_lap_limit . ' laps';
        if($this->race_time_limit) return $this->race_time_limit . ' minutes';
        return '';
    }

    public function formatRaceWeekNum()
    {
        return 'Week ' . $this->week_number;
    }

    public function tooltipText()
    {
        $lines = [$this->formatRaceWeekNum() .', '. $this->start_date->format('F j')];
        $lines[] = $this->formatStartType() .', '. $this->formatRaceLength();

        return implode('<br>', $lines);
    }
}
