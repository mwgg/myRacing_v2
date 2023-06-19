<?php

namespace App\Jobs;

use App\Models\Car;

class UpdateCars extends UpdateData
{
    public function handle(): void
    {
        $cars = $this->iracing->car->get();

        foreach($cars as $c)
        {
            $car = Car::firstOrCreate(
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
