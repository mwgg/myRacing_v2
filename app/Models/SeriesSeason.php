<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class SeriesSeason extends Model
{
    protected $fillable = [
        'fixed_setup',
        'is_heat_racing',
        'license_group',
        'multiclass',
        'official',
        'schedule_description',
        'season_id',
        'season_short_name',
        'season_year',
        'season_quarter',
        'series_id',
        'start_date',
        'active',
    ];

    protected $casts = [
        'start_date' => 'datetime:Y-m-d H:i:s',
    ];

    public function series(): BelongsTo
    {
        return $this->belongsTo(Series::class);
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(SeriesSchedule::class, 'season_id', 'season_id');
    }

    public function carClasses(): BelongsToMany
    {
        return $this->belongsToMany(CarClass::class, 'series_season_car_class', 'season_id', 'car_class_id', 'season_id', 'car_class_id');
    }

    public function weekSchedule($startOfRaceWeek): Collection
    {
        return $this->schedules
            ->where('start_date', '>=', $startOfRaceWeek)
            ->where('start_date', '<', $startOfRaceWeek->copy()->addWeek());
    }

    public function formatSetupType(): string
    {
        return ($this->fixed_setup ? 'Fixed' : 'Open') . ' setup';
    }

    public function formatOfficialStatus(): string
    {
        return $this->official ? 'Official' : 'Unofficial';
    }
}
