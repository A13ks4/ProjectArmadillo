<?php

use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\City::class, 10)->create()->each(function($c) {
            $c->streets()->sync(App\Street::all()->random(rand(6,12)));
        });;
    }
}
