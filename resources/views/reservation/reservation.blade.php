@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-lg-10 col-md-12">
            <div class="card">
                <div class="card-header">
                    <nav class="navbar">
                        <ul class="navbar-nav mr-auto">
                            <span class="navbar-brand">Vozni park</span>
                        </ul>
                        <ul class="navbar-nav ml-auto">
                            @can('create', App\reservation::class)
                                <a href="/reservation/create" class="btn btn-primary">Novo vozilo</a>
                            @endcan
                        </ul>
                    </nav>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Korisnik</th>
                            <th scope="col">Plan</th>
                            <th scope="col">Startna lokacija</th>
                            <th scope="col">Destinacija</th>
                            
                            <th scope="col"></th>
                        </tr>
                    @foreach($reservations as $reservation)
                    @can('view',$reservation)
                        <tr>
                            <td class="text-center"><img class="rounded-circle" width="35px" height="35px" src="{{$reservation->img}}" alt="none"></td>
                            <td>{{$reservation->user->firstname}}</td>
                            <td>{{$reservation->plan->city_from->name}} - {{$reservation->plan->city_to->name}}</td>
                            <td>{{$reservation->start_location}}</td>
                            <td>{{$reservation->destination}}</td>
                            
                        @can('create', $reservation)
                            <td>
                                <div class="row">
                                    <div class="col">
                                        <a class="mr-2" href="#" onclick="reservation = {{$reservation}}; showpopup()">
                                            <img width="15px" height="15px" src="{{ asset('svg/eye.svg') }}">
                                        </a>
                                        <a class="mr-2" href="/reservation/{{$reservation->id}}/edit">
                                            <img width="15px" height="15px" src="{{ asset('svg/pencil.svg') }}">
                                        </a>
                                        <a class="mr-2" href="{{url('reservation/'.$reservation->id)}}" onclick="event.preventDefault(); $('#delete-form{{$reservation->id}}').submit()">
                                            <img width="15px" height="15px" src="{{ asset('svg/minus.svg') }}">
                                        </a>  
                                    </div>
                                    <form id="delete-form{{$reservation->id}}" action="/reservation/{{$reservation->id}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                </div>
                            </td>
                        @endcan
                        </tr>
                    @endcan
                    @endforeach 
                    </table>
                    
                    {{$reservations->links()}}
                    <div id="popup" class="modal container">
                        <div class="modal-content animate">
                            <div class="imgcontainer">
                                <span onclick="document.getElementById('popup').style.display='none'" class="close" title="Close Modal">&times;</span>
                                <img id="popupimg" width="280px" height="280px" src="" alt="none" class="rounded-circle">
                            </div>
                            <div class="container">
                                <div class="text-center mb-4">
                                    <h3 id="popupbrand"></h3>
                                    <h5 id="popupmodel"></h2>
                                </div>
                                <button onclick="document.getElementById('popup').style.display='none'">Zatvori</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
<script>
    var reservation;
    function showpopup() {
        document.getElementById('popup').style.display= 'block';
        document.getElementById('popupimg').src = reservation.img;
        document.getElementById('popupbrand').innerHTML = reservation.brand;
        document.getElementById('popupmodel').innerHTML = reservation.model;
    }
</script>