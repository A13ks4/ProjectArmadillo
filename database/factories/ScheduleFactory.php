<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Schedule;
use Faker\Generator as Faker;

$factory->define(Schedule::class, function (Faker $faker) {
    return [
        "plan_id" => $faker->randomDigitNotNull,
        "vehicle_id" => function(){ return factory(App\Vehicle::class)->create()->id; },
        "driver_id" => function(){ return factory(App\User::class)->create()->id; },
    ];
});
