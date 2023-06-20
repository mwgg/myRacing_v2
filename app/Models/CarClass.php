<?php

namespace App\Models;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarClass extends Model
{
    use HasFactory, Cachable;

    protected $fillable = [
        'car_class_id',
        'name',
    ];

    public function cars()
    {
        return $this->belongsToMany(Car::class, 'car_class_car', 'car_class_id', 'car_id', 'car_class_id', 'car_id');
    }
}
