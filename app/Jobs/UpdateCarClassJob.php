<?php

namespace App\Jobs;

use App\Models\CarClass;
use iRacingPHP\iRacing;

class UpdateCarClassJob extends UpdateDataJob
{
    public function handle(iRacing $iracing): void
    {
        $classes = $iracing->carclass->get();

        foreach($classes as $c)
        {
            $carClass = CarClass::updateOrCreate(
                [
                    'car_class_id' => $c->car_class_id
                ],
                [
                    'name' => $c->name,
                ]
            );

            $carIds = array_column($c->cars_in_class, 'car_id');
            $carClass->cars()->sync($carIds);
        }
    }
}
