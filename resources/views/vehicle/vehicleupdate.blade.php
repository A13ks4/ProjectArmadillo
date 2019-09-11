@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-5 col-md-8">
            <div class="card">
                <div class="card-header">Izmena vozila</div>
                <div class="card-body">
                    <div class="imgcontainer">
                        <img id="popupimg" width="100px" height="100px" src="@if($vehicle->isImgLocal()) ../../{{$vehicle->img}} @else {{$vehicle->img}} @endif" alt="none" class="rounded-circle">
                    </div>
                    <form action="/vehicle/{{$vehicle->id}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('PATCH')
                        <span>Br. reg-tablica:</span>
                        <input type="text" class="form-control" name="plate_number" value="{{$vehicle->plate_number}}"><br>
                        <span>Brend:</span>
                        <input type="text" class="form-control" name="brand" value="{{$vehicle->brand}}"><br>
                        <span>Model:</span>
                        <input type="text" class="form-control" name="model" value="{{$vehicle->model}}"><br>
                        <span>Boja:</span>
                        <input type="text" class="form-control" name="color" value="{{$vehicle->color}}"><br>
                        <span>Br. sedista:</span>
                        <input type="number" class="form-control" name="seats_number" value="{{$vehicle->seats_number}}"><br>
                        <span>Slika:</span>
                        <div class="custom-file">
                            <input type="file" name="image"  class="custom-file-input" id="fileInput" onChange="test()" aria-describedby="inputGroupFileAddon01">
                            <label id="fileInputlabel" class="custom-file-label" for="inputGroupFileAddon01">Izaberi fajl</label>
                        </div> <br> <br>
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