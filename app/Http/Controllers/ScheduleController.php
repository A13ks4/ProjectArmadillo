<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plan;
use App\Vehicle;
class ScheduleController extends Controller
{

    public function __construct(){
        $this->middleware('admin')->except('index');
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = Schedule::all();
        return view('schedule/schedule',compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("schedule/schedulecreate");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([  
            'plan_id' => 'required',
            'vehicle_id' => 'required',
            'driver_id' => 'required'
        ]);
        $v = Vehicle::find($data['vehicle_id']);
        $pl = Plan::find($data['plan_id']);
        $p->space = $p->space + $v->seats_number;
        $p->save();

        $schedule = new Schedule;
        $schedule->driver_id = $data['driver_id'];
        $schedule->plan_id = $data['plan_id'];
        $schedule->vehicle_id = $data['vehicle_id'];
        $schedule->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vehicle = Schedule::find($id);
        $vehicle->delete();
        return redirect('schedule');
    }
}
