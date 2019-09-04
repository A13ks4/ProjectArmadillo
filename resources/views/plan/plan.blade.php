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
                        <tr><td>City from:</td><td>City to:</td><td>Vehicle:</td><td>Driver:</td><td>Time start:</td><td>Time end:</td></tr>
                        @foreach ($plans as $plan)
                           
                            <tr><td>{{ $plan->city_from->name }}</td>
                            <td>{{ $plan->city_to->name }}</td>
                            <td>{{ $plan->schedule->vehicle->brand }}</td>
                            <td>{{ $plan->schedule->driver->firstname }}</td>
                            <td>{{ $plan->time_start }}</td>
                            <td>{{ $plan->time_end }}</td>
                            @can('update',$plan)
                            <td><button class="reserve">reserve</button></td>
                            @endcan
                            @can('update',$plan)
                            <td><a href="plan/{{$plan->id}}/edit">edit</a></td>
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