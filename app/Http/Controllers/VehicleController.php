<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vehicle;
class VehicleController extends Controller
{

    public function __construct(){
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicles = Vehicle::all();
        return view('vehicle/vehicle', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Vehicle::class);
        return view('vehicle/vehiclecreate');
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
            'brand' => 'required',
            'model' => 'required',
            'color' => 'required',
            'plate_number' => 'required',
            'seats_number' => 'required',
            'img' => '',
        ]);
        $vehicle = new Vehicle;
        $vehicle->brand = $data['brand'];
        $vehicle->brand = $data['model'];
        $vehicle->brand = $data['color'];
        $vehicle->brand = $data['plate_number'];
        $vehicle->brand = $data['seats_number'];
        $vehicle->save();
        return redirect('vehicle');
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
        $vehicle = Vehicle::findOrFail($id);
        $this->authorize('update',$vehicle);
        return view('vehicleupdate',compact('vehicle'));
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
            'brand' => 'required',
            'model' => 'required',
            'color' => 'required',
            'plate_number' => 'required',
            'seats_number' => 'required',
            'img' => '',
        ]);
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->brand = $data['brand'];
        $vehicle->brand = $data['model'];
        $vehicle->brand = $data['color'];
        $vehicle->brand = $data['plate_number'];
        $vehicle->brand = $data['seats_number'];
        $vehicle->save();
        return redirect('vehicle');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vehicle = Vehicle::findorFail($id);
        $vehicle->delete();
    }
}
