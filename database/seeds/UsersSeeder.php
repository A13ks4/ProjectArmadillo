<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            "firstname" => "Adminstrator",
            "lastname" => "",
            "email" => "admin@gmail.com",
            "password" => bcrypt("admin"),
            'img' => "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_640.png",
            'level' => 3,
        ]);
        User::insert([
            "firstname" => "Marko",
            "lastname" => "Nikolic",
            "email" => "marko@gmail.com",
            "password" => bcrypt("password"),
            'img' => "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_640.png",
            "level" => 2,
        ]);
        User::insert([
            "firstname" => "Milena",
            "lastname" => "Lazarevic",
            "email" => "milena@gmail.com",
            "password" => bcrypt("password"),
            'img' => "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_640.png",
            "level" => 1,
        ]);
        factory(App\User::class,7)->create();
    }
}
