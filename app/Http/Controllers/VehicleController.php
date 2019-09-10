<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vehicle;
class VehicleController extends Controller
{

    public function __construct(){
        $this->middleware('admin');
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicles = Vehicle::paginate(5);
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
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ]);
        $vehicle = new Vehicle;
        $vehicle->brand = $data['brand'];
        $vehicle->model = $data['model'];
        $vehicle->color = $data['color'];
        $vehicle->plate_number = $data['plate_number'];
        $vehicle->seats_number = $data['seats_number'];
        $imagePath = $request->file('image')->store("uploads", "public");
        $vehicle->img = "storage/".$imagePath;
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
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ]);
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->brand = $data['brand'];
        $vehicle->model = $data['model'];
        $vehicle->color = $data['color'];
        $vehicle->plate_number = $data['plate_number'];
        $vehicle->seats_number = $data['seats_number'];
        $imagePath = $request->file('image')->store("uploads", "public");
        $vehicle->img = "storage/".$imagePath;
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
   
        $vehicle = Vehicle::find($id);
        $vehicle->delete();
        return redirect('vehicle');
    }
}
