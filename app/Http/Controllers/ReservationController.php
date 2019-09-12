<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;
use App\Plan;
class ReservationController extends Controller
{

    public function __construct(){
        $this->middleware('admin')->except('index','store');
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = Reservation::paginate(5);
        return view('reservation/reservation',compact('reservations'));
    }

    public function reserve($id){
        $plan = Plan::findOrFail($id);
        return view('reservation/reservationadd',compact('plan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reservation/reservationcreate');
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
            'street' => 'required',
            'start_location' => 'required',
        ]);
        $pl = Plan::find($data['plan_id']);
        if($pl != null && $pl->space == 0){
            return "No more free space";
        }
        
        //Proverava da li postoji rezervacija sa id plana i id usera
        if(Reservation::where("plan_id",$data['plan_id'])->where("user_id",auth()->user()->id)->exists()){
            return "Plan already reserved ";
        }
        
        $reservation = new Reservation;
        $reservation->user_id = auth()->user()->id;
        $reservation->plan_id = $data['plan_id'];
        $reservation->destination = $data['street'];
        $reservation->start_location = $data['start_location'];     
        $reservation->save();
        
        $plan = Plan::findOrFail($data['plan_id']);
        $plan->space =  $plan->space - 1;
        $plan->save();
        return "successfuly added plan num: ".$reservation->plan_id;
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
        $reservation = Reservation::findOrFail($id);
        $this->authorize('update',$reservation);
        return view('reservation/reservationupdate');
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
            'street' => 'required',
            'start_location' => 'required',
        ]);

        $reservation = Reservation::findOrFail($id);
        $reservation->user_id = auth()->user()->id;
        $reservation->plan_id = $data['plan_id'];
        $reservation->destination = $data['street'];
        $reservation->start_location = $data['start_location'];     
        $reservation->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plan = Reservation::findOrFail($id);
        $plan->delete();
    }
}
