<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedule;
use App\Plan;
use App\User;
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
    public function index(Request $request)
    {
        $schedules = Schedule::paginate(5);
        if($request->ajax()){
            $html = \View::make('schedule/scheduletable',compact('schedules'));
            return \Response::json($html->render());
        }
        return view('schedule/schedule',compact('schedules'));
    }

    public function export_pdf(){
        $schedules = Schedule::all();

        $pdf = \PDF::loadView('schedule/pdf',compact('schedules'));
        return $pdf->download("rezervacije.pdf");

    } 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $plans = Plan::all();
        $vehicles = Vehicle::all();
        $employees = User::where('level',"2")->get();
        return view("schedule/schedulecreate", compact('plans','vehicles','employees'));
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
        $pl->space = $pl->space + ($v->seats_number-1);//-1 za Vozaca
        $pl->save();

        $schedule = new Schedule;
        $schedule->driver_id = $data['driver_id'];
        $schedule->plan_id = $data['plan_id'];
        $schedule->vehicle_id = $data['vehicle_id'];
        $schedule->save();
        return redirect('schedule');
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
        $schedule = Schedule::findOrFail($id);
        $plans = Plan::all();
        $vehicles = Vehicle::all();
        $employees = User::where('level',"2")->get();
        return view('schedule/scheduleupdate', compact('schedule','plans','vehicles','employees'));
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
        $data = $request->validate([  
            'plan_id' => 'required',
            'vehicle_id' => 'required',
            'driver_id' => 'required'
        ]);
        $schedule = Schedule::findOrFail($id);

        $v = Vehicle::find($data['vehicle_id']);
        $pl = Plan::find($data['plan_id']);
        $pl->space = $pl->space - $schedule->vehicle->seats_number+1 + ($v->seats_number-1);//-1 za Vozaca
        $pl->save();

        
        $schedule->driver_id = $data['driver_id'];
        $schedule->plan_id = $data['plan_id'];
        $schedule->vehicle_id = $data['vehicle_id'];
        $schedule->save();
        return redirect('schedule');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $schedule = Schedule::find($id);

        $plan = Plan::findOrFail($schedule->plan_id);
        $plan->space = $plan->space - $schedule->vehicle->seats_number+1;
        $plan->save();

        $schedule->delete();
        return redirect('schedule');
    }
}
