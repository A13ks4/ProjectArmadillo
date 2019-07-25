@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Vehicles</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div>
                        <span>Vehicles go here</span>
                        <br>
                        <a href="/vehicle/create" class="btn btn-primary">+</a>
                        <br>
                        @foreach($vehicles as $vehicle)
                            <p>{{$vehicle->brand}}</p>
                        @can('update',$vehicle)
                            <a href="/vehicle/{{$vehicle->id}}/edit">edit</a>
                        @endcan
                        @endforeach
                            
                    </div>
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection