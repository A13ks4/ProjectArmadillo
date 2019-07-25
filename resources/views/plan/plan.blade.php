@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div>
                        <span>Plans go here</span>
                        <br>
                        <a href="/plan/create" class="btn btn-primary">+</a>
                        <br>
                        @foreach ($plans as $plan)
                           
                            <p>City From:  {{ $plan->city_from->name }}</p>
                            <p>City To:  {{ $plan->city_to->name }}</p>
                            <p>Vehicle:  {{ $plan->vehicle->brand }}</p>
                            @can('update',$plan)
                            <a href="plan/{{$plan->id}}/edit">edit</a>
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