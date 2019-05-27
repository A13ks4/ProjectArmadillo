<?php

use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Plan::class, 5)->create();
        factory(App\User::class, 5)->create()->each(function($u) {
            $u->plans()->attach(App\User::all()->random(3));
        });
    }
}
