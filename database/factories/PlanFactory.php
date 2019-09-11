<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Plan;
use Faker\Generator as Faker;

$factory->define(Plan::class, function (Faker $faker) {
    return [
        'date' => $faker->date('Y-m-d H:i:s'), 
        'time_start' => $faker->time('H:i:s'),
        'time_end' => $faker->time('H:i:s'),
        'price' => $faker->numberBetween(100, 1000),
        'space' => 0,
        'city_id_from' => $faker->numberBetween(1, 5),
        'city_id_to' => $faker->numberBetween(1, 5),
    ];
});
