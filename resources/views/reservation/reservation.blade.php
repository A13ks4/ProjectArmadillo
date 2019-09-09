@extends('layouts.app')

@section('content')
<script>
 $(function(){
     $(".reserve").click(function(){
    $(".added").fadeIn();
    $(".added").fadeOut(1000);
 });
 })
</script>
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
                        
                        <form action="/search" method="GET">
                        @csrf
                            <select name="city_from" id="">
                           <?php $cities = App\City::all();?>
                            @foreach ($cities as $city)
                                <option value="{{$city->id}}">{{$city->name}}</option>
                            @endforeach
                            </select>
                            <select name="city_to" id="">
                           <?php $cities = App\City::all();?>
                            @foreach ($cities as $city)
                                <option value="{{$city->id}}">{{$city->name}}</option>
                            @endforeach
                            </select>
                            <button class="btn" type="submit">Search</button>
                        </form>

                        @can('create', App\Plan::class)<a href="/plan/create" class="btn btn-primary">+</a>@endcan
                        <br>
                        <table class="table table-striped table-hover"> 
                        <tr><td>User:</td><td>Plan:</td><td>Vehicle:</td></tr>
                        @foreach ($reservations as $reservation)
                           @can('view',$reservation) <!-- Samo odlucuje za drivera i usera koje da prikaze, admin vidi sve -->
                            <tr><td>{{ $reservation->user_id }}</td>
                            <td>{{ $reservation->plan_id }}</td>
                            <td>{{ $reservation->plan->schedule->vehicle->brand }}</td>
                            
                           @endcan
                           
                            </tr>
                        @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="added" style="background:green; display:none; border: 1px solid black; position:absolute; bottom:0; right:0; width: 200px; ">Reserved</div>

@endsection