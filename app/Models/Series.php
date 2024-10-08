<?php

namespace App\Models;

use App\iRacing\Constants;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;

class Series extends Model
{
    protected $fillable = [
        'series_id',
        'series_name',
        'category_id',
        'forum_url',
        'logo_url',
    ];

    public function seasons(): HasMany
    {
        return $this->hasMany(SeriesSeason::class, 'series_id', 'series_id');
    }

    public function currentSeason(): HasOne
    {
        return $this->hasOne(SeriesSeason::class, 'series_id', 'series_id')
            ->where('active', true)
            ->whereHas('schedules', function ($query) {
                $query->where('start_date', '>=', Carbon::now()->startOfWeek(2)->startOfDay());
            });
    }

    public static function withCurrentSeasonSchedules($sortByLicense = true): Collection
    {
        $series = Series::with(
            'currentSeason',
            'currentSeason.schedules',
            'currentSeason.schedules.track',
            'currentSeason.schedules.cars:car_id,car_name',
            'currentSeason.carClasses',
            'currentSeason.carClasses.cars:car_id,car_name'
        )
            ->whereHas('currentSeason')
            ->orderBy('category_id')
            ->orderBy('series_name')
            ->get();

        if ($sortByLicense) {
            $series = $series->sortByDesc('currentSeason.license_group');
        }

        return $series->groupBy('category_id');
    }

    public function tooltipText(): string
    {
        $line2 = [];
        $line2[] = Constants::LIC_NAMES[$this->currentSeason->license_group];
        if ($this->currentSeason->is_heat_racing) $line2[] = 'Heat racing';
        $line2[] = $this->currentSeason->formatSetupType();
        $line2[] = $this->currentSeason->formatOfficialStatus();

        $lines = [$this->series_name];
        $lines[] = implode(', ', $line2);
        $lines[] = $this->currentSeason->schedule_description;
        $lines[] = '';

        $cars = [];
        foreach ($this->currentSeason->carClasses as $carClass) {
            $carNames = array_column($carClass->cars->toArray(), 'car_name');
            $cars = array_merge($carNames, $cars);
        }
        $lines[] = implode('<br>', $cars);

        return implode('<br>', $lines);
    }
}
