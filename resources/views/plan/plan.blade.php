@extends('layouts.app')

@section('content')
<script>
 $(function(){ 
    $(".reserve").click(function(ev){
        ev.preventDefault();  
        var plan_id = $(this).val();
        
        $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: "POST",
        url:    "/reservation",
        data: {plan_id:plan_id},
        success: function(data){
            $(".added").html(data);
            $(".added").fadeIn(500);
            $(".added").fadeOut(1500);
        }
        });
    })
    $(".search").click(function(ev){
        ev.preventDefault();  
        var from = $("#from option:selected").val();
        var to = $("#to option:selected").val();

        $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: "GET",
        url:    "/search",
        data: {city_from:from, city_to:to},
        success: function(data){
            
    
            $(".table").html("");
            var html = "<tr><td>"+ data.cities[0].id + "</td></tr>";
            $.each(data, function(i, item){
                
                var j = $.parseJSON(item);
                //alert(data.plans.id);
                console.log(j[4].id);
                console.log(data);
                console.log(item);
                //html += "<tr><td>"+ j[0].name + "</td>";
                //html += "<tr><td>"+ data.plans[0] + "</td></tr>";
               
            });
            $(".table").append(html);
        }
        });
    })
 });
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
                            <select name="city_from" id="from">
                           
                            @foreach ($cities as $city)
                                <option value="{{$city->id}}">{{$city->name}}</option>
                            @endforeach
                            </select>
                            <select name="city_to" id="to">
                           
                            @foreach ($cities as $city)
                                <option value="{{$city->id}}">{{$city->name}}</option>
                            @endforeach
                            </select>
                            <button class="btn search" type="submit">Search</button>
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
                            
                            <td> <form action="{{url('reservation')}}" method="POST">
                            @csrf
                                
                                <input type="hidden" name="plan_id" value="{{$plan->id}}">
                                <button class="reserve" type="submit" value="{{$plan->id}}">reserve</button>
                            </form>
                            </td>
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