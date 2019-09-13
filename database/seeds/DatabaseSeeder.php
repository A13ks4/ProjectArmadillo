<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       /* $date = Carbon::create(2015, 5, 28, 0, 0, 0);
        DB::table('users')->insert([
            'firstname' => Str::random(10),
            'lastname' => Str::random(10),
            'phone_number' => Str::random(10),
            'gender' => Str::random(10),
            'img' => Str::random(10),
            'city_id' => rand(),
            'street_id' => rand(),
            'date_of_birth' => $date->format('Y-m-d H:i:s'),
            'email' => Str::random(10).'@gmail.com',
            'password' => bcrypt('secret'),
        ]);*/
        //$user = factory(App\User::class, 5)->create();
        $this->call([
            StreetSeeder::class,
            VehicleSeeder::class,
            UsersSeeder::class,
            CitySeeder::class,
            PlanSeeder::class,
            
        ]);
    }
}
