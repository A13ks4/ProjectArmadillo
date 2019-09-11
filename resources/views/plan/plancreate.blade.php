@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-5 col-md-8">
            <div class="card">
                <div class="card-header">Novi plan (ruta)</div>
                <div class="card-body">
                    <form action="/plan" enctype="multipart/form-data" method="POST">
                    @csrf
                        <span>Od:</span> <br>
                        <select class="form-control" name="city_id_from" id="from">
                        <option value=""></option>
                        @foreach($cities as $city)
                        <option value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                        </select>
                        <span>Do:</span> <br>
                        <select class="form-control" name="city_id_to" id="to">
                        <option value=""></option>
                        @foreach($cities as $city)
                        <option value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                        </select>
                        <span>Polazak:</span>
                        <input type="time" class="form-control" name="time_start" ><br>
                        <span>Dolazak:</span>
                        <input type="time" class="form-control" name="time_end" ><br>
                        <span>Datum:</span>
                        <input type="date" class="form-control" name="date" ><br>
                        <span>Cena:</span>
                        <input type="number" class="form-control" name="price" value="0"><br>
                        <div class="row justify-content-center">
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Dodaj plan') }}
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