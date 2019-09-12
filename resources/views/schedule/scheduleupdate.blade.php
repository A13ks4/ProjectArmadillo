@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-5 col-md-8">
            <div class="card">
                <div class="card-header">Izmena zaduzenja</div>
                <div class="card-body">
                    <form action="/schedule/{{$schedule->id}}" method="POST">
                    @csrf
                    @method("PATCH")
                        <span>Plan:</span>
                        <select class="form-control" name="plan_id" id="plan_id">
                            @foreach($plans as $plan)
                                <option @if($plan->id == $schedule->plan->id) selected @endif value="{{$plan->id}}">{{$plan->city_from->name}} - {{$plan->city_to->name}} Dan: {{$plan->date}} Vreme: {{$plan->time_start}}</option>
                            @endforeach
                        </select><br>
                        <span>Vozilo:</span>
                        <select class="form-control" name="vehicle_id" id="vehicle_id">
                            @foreach($vehicles as $vehicle)
                                <option @if($vehicle->id == $schedule->vehicle->id) selected @endif value="{{$vehicle->id}}">{{$vehicle->brand}} {{$vehicle->model}}</option>
                            @endforeach
                        </select><br>
                        <span>Vozac:</span>
                        <select class="form-control" name="driver_id" id="driver_id">
                            @foreach($employees as $employee)
                                <option @if($employee->id == $schedule->driver->id) selected @endif value="{{$employee->id}}">{{$employee->firstname}} {{$employee->lastname}}</option>
                            @endforeach
                        </select><br>
                        
                        <div class="row justify-content-center">
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Izmeni') }}
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