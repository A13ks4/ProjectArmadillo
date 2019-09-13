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
    if(Auth::check()) {
        return Redirect::to('home');
    }
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/search', 'PlanController@search');
Route::get('/employees', 'UserController@employees');
Route::post('/upgradeUser/{id}', 'UserController@upgradeUser');
Route::get('/reservation/{id}/reserve', 'ReservationController@reserve');
Route::get('/reservation/pdf','ReservationController@export_pdf');
Route::get('/schedule/pdf','ScheduleController@export_pdf');
Route::get('/reservation/word','ReservationController@export_word');
Route::resource('/plan', 'PlanController');
Route::resource('/user', 'UserController');
Route::resource('/reservation', 'ReservationController');
Route::resource('/schedule', 'ScheduleController');
Route::resource('/city', 'CityController');
Route::resource('/street', 'StreetController');
Route::resource('/vehicle', 'VehicleController');
