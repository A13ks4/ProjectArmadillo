<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Vehicle;
use Faker\Generator as Faker;

$factory->define(Vehicle::class, function (Faker $faker) {
    $faker->addProvider(new \Faker\Provider\Fakecar($faker));
    return [
        'brand' => $faker->vehicleBrand,
        'model' => $faker->vehicleModel,
        'color' => $faker->colorName,
        'plate_number' => $faker->vehicleRegistration,
        'seats_number' => $faker->numberBetween(5,7),
        'img' => $faker->image(),
    ];
});
