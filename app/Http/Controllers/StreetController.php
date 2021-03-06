<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Street;
class StreetController extends Controller
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
        $streets = Street::all();
        return view('street/street',compact('streets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('street/streetcreate');
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
            'streetName' => 'required',
        ]);
        $street = new Street;
        $street->name = $data['streetName'];
        $street->save();
        return redirect('street');
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
        $street = Street::findOrFail($id);
        $this->authorize('update',$street);
        return view('street/streetupdate',compact('street'));
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
            'streetName' => 'required',
        ]);
        $street = Street::find($id);
        $street->name = $data['streetName'];
        $street->save();
        return redirect('street');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $street = Street::findOrFail($id);
        $street->delete();
    }
}
