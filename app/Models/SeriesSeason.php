<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeriesSeason extends Model
{
    use HasFactory;

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
        return $this->hasMany(SeriesSchedule::class, 'series_id', 'series_id');
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
