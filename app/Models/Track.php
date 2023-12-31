<?php

namespace App\Models;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    use HasFactory, Cachable;

    protected $fillable = [
        'category_id',
        'free',
        'location',
        'package_id',
        'track_id',
        'price',
        'sku',
        'name',
        'config_name',
        'image_url',
        'logo_url',
        'map_url',
    ];

}
