<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Schedule;
use Faker\Generator as Faker;

$factory->define(Schedule::class, function (Faker $faker) {
    return [
        "plan_id" => $faker->numberBetween(1, 5),
        "vehicle_id" => $faker->numberBetween(1, 8),
        "driver_id" => function(){ return factory(App\User::class)->create()->id; },
    ];
});
