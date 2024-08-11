<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CarClass extends Model
{
    protected $fillable = [
        'car_class_id',
        'name',
    ];

    public function cars(): BelongsToMany
    {
        return $this->belongsToMany(Car::class, 'car_class_car', 'car_class_id', 'car_id', 'car_class_id', 'car_id');
    }
}
