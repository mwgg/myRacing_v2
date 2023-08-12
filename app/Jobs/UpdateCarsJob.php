<?php

namespace App\Jobs;

use App\Models\Car;
use iRacingPHP\iRacing;

class UpdateCarsJob extends UpdateDataJob
{
    public function handle(iRacing $iracing): void
    {
        $cars = $iracing->car->get();

        foreach($cars as $c)
        {
            $car = Car::updateOrCreate(
                [
                    'car_id' => $c->car_id
                ],
                [
                    'car_name' => $c->car_name,
                ]
            );
        }
    }
}
