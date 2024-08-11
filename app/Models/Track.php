<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
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
