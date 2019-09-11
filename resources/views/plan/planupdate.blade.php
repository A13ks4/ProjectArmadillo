@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-5 col-md-8">
            <div class="card">
                <div class="card-header">Izmena plana</div>
                <div class="card-body">
                    <form action="/plan/{{$plan->id}}" method="POST">
                    @csrf
                    @method('PATCH')
                        <span>Od:</span> <br>
                        <select class="form-control" name="city_id_from" id="from">
                            @foreach($cities as $city)
                                <option @if($plan->city_id_from == $city->id) selected @endif value="{{$city->id}}">{{$city->name}}</option>
                            @endforeach
                        </select><br>
                        <span>Do:</span> <br>
                        <select class="form-control" name="city_id_to" id="from">
                            @foreach($cities as $city)
                                <option @if($plan->city_id_to == $city->id) selected @endif value="{{$city->id}}">{{$city->name}}</option>
                            @endforeach
                        </select><br>
                        <span>Polazak:</span>
                        <input type="time" class="form-control" name="time_start" value="{{$plan->time_start}}"><br>
                        <span>Dolazak:</span>
                        <input type="time" class="form-control" name="time_end" value="{{$plan->time_end}}"><br>
                        <span>Datum:</span>
                        <input type="date" class="form-control" name="date" value="{{$plan->date}}"><br>
                        <span>Cena:</span>
                        <input type="number" class="form-control" name="price" value="{{$plan->price}}"><br>
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