<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Street;
use Faker\Generator as Faker;

$factory->define(Street::class, function (Faker $faker) {
    return [
        'name' => $faker->streetName,
    ];
});
