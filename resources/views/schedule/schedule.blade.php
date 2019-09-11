@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-lg-10 col-md-12">
            <div class="card">
                <div class="card-header">
                    <nav class="navbar">
                        <ul class="navbar-nav mr-auto">
                            <span class="navbar-brand">Zaduzenja</span>
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
                            <th scope="col">Vozac:</th>
                            <th scope="col">Relacija:</th>
                            <th scope="col">Polazak:</th>
                            <th scope="col">Vozilo:</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                        @foreach($schedules as $schedule)
                            <tr>
                                <td><img class="rounded-circle mr-2" width="35px" height="35px" src="{{$schedule->driver->img}}" alt="none"> {{$schedule->driver->firstname}} {{$schedule->driver->lastname}}</td>
                                <td>{{$schedule->plan->city_from->name}} - {{$schedule->plan->city_to->name}}</td>
                                <td>{{$schedule->plan->time_start}}</td>
                                <td>{{$schedule->vehicle->brand}} {{$schedule->vehicle->model}}</td> 
                                @can('create', $schedule)
                                    <td>
                                        <div class="row">
                                            <div class="col">
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 