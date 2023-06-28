<?php

namespace App\Models;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeriesSeason extends Model
{
    use HasFactory, Cachable;

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

    public function series()
    {
        return $this->belongsTo(Series::class);
    }

    public function schedules()
    {
        return $this->hasMany(SeriesSchedule::class, 'season_id', 'season_id');
    }

    public function carClasses()
    {
        return $this->belongsToMany(CarClass::class, 'series_season_car_class', 'season_id', 'car_class_id', 'season_id', 'car_class_id');
    }

    public function weekSchedule($startOfRaceWeek)
    {
        return $this->schedules
            ->where('start_date', '>=', $startOfRaceWeek)
            ->where('start_date', '<', $startOfRaceWeek->copy()->addWeek());
    }

    public function formatSetupType()
    {
        return ($this->fixed_setup ? 'Fixed' : 'Open') . ' setup';
    }

    public function formatOfficialStatus()
    {
        return $this->official ? 'Official' : 'Unofficial';
    }
}
