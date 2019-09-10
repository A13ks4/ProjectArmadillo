@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-10 col-md-12">
            <div class="card">
                <div class="card-header">
                    <nav class="navbar">
                        <ul class="navbar-nav mr-auto">
                            <span class="navbar-brand">Vozni park</span>
                        </ul>
                        <ul class="navbar-nav ml-auto">
                            @can('create', App\Vehicle::class)
                                <a href="/vehicle/create" class="btn btn-primary">Novo vozilo</a>
                            @endcan
                        </ul>
                    </nav>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-sm table-hover"> 
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Br. reg-tablica</th>
                            <th scope="col">Brend</th>
                            <th scope="col">Model</th>
                            <th scope="col">Boja</th>
                            <th scope="col">Br. sedista</th>
                            <th scope="col">Akcija</th>
                        </tr>
                    @foreach($vehicles as $vehicle)
                        <tr>
                            <td class="text-center"><img class="rounded-circle" width="35px" height="35px" src="{{$vehicle->img}}" alt="none"></td>
                            <td>{{$vehicle->plate_number}}</td>
                            <td>{{$vehicle->brand}}</td>
                            <td>{{$vehicle->model}}</td>
                            <td>{{$vehicle->color}}</td>
                            <td>{{$vehicle->seats_number}}</td>
                        @can('create', $vehicle)
                            <td>
                                <a href="#"> <!-- Mozda bude pop-up -->
                                    <img class="mr-2 mb-1" width="15px" height="15px" src="{{ asset('svg/eye.svg') }}">
                                </a>
                                <a href="/vehicle/{{$vehicle->id}}/edit">
                                    <img class="mr-2 mb-1" width="15px" height="15px" src="{{ asset('svg/pencil.svg') }}">
                                </a>
                                <form action="/vehicle/{{$vehicle->id}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button>
                                        <img class="mr-2 mb-1" width="15px" height="15px" src="{{ asset('svg/minus.svg') }}">
                                </button>
                                </form>
                            </td>
                        @endcan
                        </tr>
                    @endforeach 
                    </table>
                    {{$vehicles->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection