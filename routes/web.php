<?php

use App\Street;
use App\Vehicle;
use App\Plan;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/search', 'PlanController@search');
Route::resource('/plan', 'PlanController');
Route::resource('/city', 'CityController');
Route::resource('/street', 'StreetController');
Route::resource('/vehicle', 'VehicleController');

 
//      ISPROBAVANJE VEZA
/*
Route::get('/city', function(){

    $street = Street::findOrFail(2);

    foreach($street->citys as $city){
    echo $city;
    }
});

Route::get('/car', function(){

    $pl = Plan::findOrFail(1);

    return $pl->vehicle;
    
});

Route::get('/plans', function(){

    $p = Plan::findOrFail(1);

   // return $p->driver;
    $c = App\Vehicle::findOrFail(1);
    foreach($c->plans as $plan)
    echo $plan;
})->middleware('admin');

Route::get('/user', function(){

    $u = App\Plan::findOrFail(1);

    //return $u->plan;//za city id =1 uzimam sve ulice
    foreach($u->users as $city){
        echo $city;
        }

});*/