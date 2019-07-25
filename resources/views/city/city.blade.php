@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cities</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div>
                        <span>Cities go here</span>
                        <br>
                        <a href="/city/create" class="btn btn-primary">+</a>
                        <br>
                        @foreach($cities as $city)
                                <p>{{$city->name}}</p>
                            @can('update',$city)
                                <a href="/city/{{$city->id}}/edit">edit</a>
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