@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-5 col-md-8">
            <div class="card">
                <div class="card-header">Novo vozilo</div>
                <div class="card-body">
                    <form action="/schedule" method="POST">
                    @csrf
                        <span>Plan:</span>
                        <select name="plan_id" id="plan_id">
                            @foreach($plans as $plan)
                                <option value="{{$plan->id}}">Od: {{$plan->city_from->name}} - Do: {{$plan->city_to->name}}</option>
                            @endforeach
                        </select><br>
                        <span>Vozilo:</span>
                        <select name="vehicle_id" id="vehicle_id">
                            @foreach($vehicles as $vehicle)
                                <option value="{{$vehicle->id}}">{{$vehicle->brand}}</option>
                            @endforeach
                        </select><br>
                        <span>Vozac:</span>
                        <select name="driver_id" id="driver_id">
                            @foreach($employees as $employee)
                                <option value="{{$employee->id}}">{{$employee->firstname}}</option>
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