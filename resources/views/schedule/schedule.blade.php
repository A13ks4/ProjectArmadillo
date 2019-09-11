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
                            @can('create', App\Schedule::class)
                                <a href="/schedule/create" class="btn btn-primary">Novo zaduzenje</a>
                            @endcan
                        </ul>
                    </nav>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Grad od:</th>
                            <th scope="col">Grad do:</th>
                            <th scope="col">Vozac:</th>
                            <th scope="col">Vozilo:</th>
                            <th scope="col"></th>
                        </tr>
                    
                    @foreach($schedules as $schedule)
                        <tr>
                            <td class="text-center"><img class="rounded-circle" width="35px" height="35px" src="{{$schedule->driver->img}}" alt="none"></td>
                            <td>{{$schedule->plan->city_from->name}}</td>
                            <td>{{$schedule->plan->city_to->name}}</td>
                            <td>{{$schedule->driver->firstname}}</td>
                            <td>{{$schedule->vehicle->brand}}</td> 
                        @can('create', $schedule)
                            <td>
                                <div class="row">
                                    <div class="col">
                                        <a class="mr-2" href="#" onclick="schedule = {{$schedule}}; showpopup()">
                                            <img width="15px" height="15px" src="{{ asset('svg/eye.svg') }}">
                                        </a>
                                        <a class="mr-2" href="/schedule/{{$schedule->id}}/edit">
                                            <img width="15px" height="15px" src="{{ asset('svg/pencil.svg') }}">
                                        </a>
                                        <a class="mr-2" href="{{url('schedule/'.$schedule->id)}}" onclick="event.preventDefault(); $('#delete-form{{$schedule->id}}').submit()">
                                            <img width="15px" height="15px" src="{{ asset('svg/minus.svg') }}">
                                        </a>  
                                    </div>
                                    <form id="delete-form{{$schedule->id}}" action="/schedule/{{$schedule->id}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                </div>
                            </td>
                        @endcan
                        </tr>
                        
                    @endforeach 
                    
                    </table>
                    
                    {{$schedules->links()}}
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
    var schedule;
    function showpopup() {
        document.getElementById('popup').style.display= 'block';
        document.getElementById('popupimg').src = schedule.img;
        document.getElementById('popupbrand').innerHTML = schedule.brand;
        document.getElementById('popupmodel').innerHTML = schedule.model;
    }
</script>