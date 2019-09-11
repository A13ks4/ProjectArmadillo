@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-5 col-md-8">
            <div class="card">
                <div class="card-header">Novo vozilo</div>
                <div class="card-body">
                    <form action="/schedule/{{$schedule->id}}" method="POST">
                    @csrf
                    @method("PATCH")
                        <span>Plan:</span>
                        <select name="plan_id" id="plan_id">
                            @foreach($plans as $plan)
                                <option @if($plan->id == $schedule->plan->id) selected @endif value="{{$plan->id}}">Od: {{$plan->city_from->name}} - Do: {{$plan->city_to->name}}</option>
                            @endforeach
                        </select><br>
                        <span>Vozilo:</span>
                        <select name="vehicle_id" id="vehicle_id">
                            @foreach($vehicles as $vehicle)
                                <option @if($vehicle->id == $schedule->vehicle->id) selected @endif value="{{$vehicle->id}}">{{$vehicle->brand}}</option>
                            @endforeach
                        </select><br>
                        <span>Vozac:</span>
                        <select name="driver_id" id="driver_id">
                            @foreach($employees as $employee)
                                <option @if($employee->id == $schedule->driver->id) selected @endif value="{{$employee->id}}">{{$employee->firstname}}</option>
                            @endforeach
                        </select><br>
                        
                        <div class="row justify-content-center">
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Dodaj zaduzenje') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection