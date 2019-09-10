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
                        <select class="form-control" name="city_from" id="from">
                        <option value="0"></option>
                        <!-- FOREACH CITY -->
                        </select>
                        <span>Do:</span> <br>
                        <select class="form-control" name="city_to" id="to">
                        <option value="0"></option>
                        <!-- FOREACH CITY -->
                        </select>
                        <span>Polazak:</span>
                        <input type="time" class="form-control" name="model" ><br>
                        <span>Dolazak:</span>
                        <input type="time" class="form-control" name="color" ><br>
                        <span>Datum:</span>
                        <input type="date" class="form-control" name="seats_number" ><br>
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