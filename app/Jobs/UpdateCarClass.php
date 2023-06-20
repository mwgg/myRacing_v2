<?php

namespace App\Jobs;

use App\Models\CarClass;

class UpdateCarClass extends UpdateData
{
    public function handle(): void
    {
        $classes = $this->iracing->carclass->get();

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
