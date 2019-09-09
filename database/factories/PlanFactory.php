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
        'space' => $faker->numberBetween(2, 8),
        'city_id_from' => function(){ return factory(App\City::class)->create()->id; },
        'city_id_to' => function(){ return factory(App\City::class)->create()->id; },
        'schedule_id' => function(){ return factory(App\Schedule::class)->create()->id; },
    ];
});
