<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use App\Plan;
use App\City;
class PlanController extends Controller
{

    public function __construct(){
        $this->middleware('admin')->except('index','search');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = Plan::all();
        $cities = City::all();
        return view('plan/plan',compact('plans'), compact('cities'));
    }
    /**
     * Display search results.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request){
        $plans = Plan::all()->where("city_id_from",$request->city_from)->where("city_id_to",$request->city_to);
        $cities = City::all();
        //\Response::json([ "plans"=>$plans->toJson(), "cities"=>$cities->toJson()])
        return [ "plans"=> $plans->toJson(), "cities" => $cities->toJson()];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create',Plan::class);
        return view('plan/plancreate');
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
            'city_id_from' => 'required',
            'city_id_to' => 'required',
            'schedule' => 'required',
            'date' => 'required',
            'time_start' => 'required',
            'time_end' => 'required',
            'price' => 'required',
        ]);
        $plan = new Plan;
        $plan->city_id_from = $data['city_id_from'];
        $plan->city_id_to = $data['city_id_to'];
        $plan->schedule = $data['schedule'];
        $plan->date = $data['date'];
        $plan->time_start = $data['time_start'];
        $plan->time_end = $data['time_end'];
        $plan->price = $data['price'];
        $plan->save();
        return redirect('plan');
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
        
        $plan = Plan::findOrFail($id);
        $this->authorize('update',$plan);
        return view('plan/planupdate', compact('plan'));
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
            'city_id_from' => 'required',
            'city_id_to' => 'required',
            'schedule' => 'required',
            'date' => 'required',
            'time_start' => 'required',
            'time_end' => 'required',
            'price' => 'required',
        ]);
        $plan = Plan::findOrFail($id);
        $plan->city_id_from = $data['city_id_from'];
        $plan->city_id_to = $data['city_id_to'];
        $plan->schedule = $data['schedule'];
        $plan->date = $data['date'];
        $plan->time_start = $data['time_start'];
        $plan->time_end = $data['time_end'];
        $plan->price = $data['price'];
        $plan->save();
        return redirect('plan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plan = Plan::findOrFail($id);
        $plan->delete();
    }
}
