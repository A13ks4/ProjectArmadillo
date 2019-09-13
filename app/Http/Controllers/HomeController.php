<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\User;
use App\Vehicle;
use App\Reservation;
use App\Schedule;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::where('level', '1')->count();
        $drivers = User::where('level', '2')->count();
        $vehicles = Vehicle::all()->count();
        $seats = Vehicle::all()->sum('seats_number');
        $cities = City::all();
        $reservations = Reservation::where('user_id', auth()->user()->id)->count();
        $schedule = Schedule::where('driver_id', auth()->user()->id)->count();
        return view('home', compact('users','drivers','vehicles','seats','cities','reservations', 'schedule'));
    }
}
