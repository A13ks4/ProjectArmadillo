@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-5 col-md-8">
            <div class="card">
                <div class="card-header">Izmena korisnika</div>
                <div class="card-body">
                    <div class="imgcontainer">
                        <img id="popupimg" width="100px" height="100px" src="@if($user->isImgLocal()) ../../{{$user->img}} @else {{$user->img}} @endif" alt="none" class="rounded-circle">
                    </div>
                    <form action="/user/{{$user->id}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('PATCH')
                        <span>Ime:</span>
                        <input type="text" class="form-control" name="firstname" value="{{$user->firstname}}"><br>
                        <span>Prezime:</span>
                        <input type="text" class="form-control" name="lastname" value="{{$user->lastname}}"><br>
                        <span>Telefon:</span>
                        <input type="text" class="form-control" name="phone_number" value="{{$user->phone_number}}"><br>
                        <span>Email:</span>
                        <input type="email" class="form-control" name="email" value="{{$user->email}}"><br>
                        <span>Slika:</span>
                        <div class="custom-file">
                            <input type="file" name="image"  class="custom-file-input" id="fileInput" onChange="test()" aria-describedby="inputGroupFileAddon01">
                            <label id="fileInputlabel" class="custom-file-label" for="inputGroupFileAddon01">Izaberi fajl</label>
                        </div> <br> <br>
                        <div class="row justify-content-center">
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Sacuvaj') }}
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