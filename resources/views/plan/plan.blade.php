@extends('layouts.app')

@section('content')
<script>
 $(function(){ 
   
    $(".search").click(function(ev){
        ev.preventDefault();  
        var from = $("#from option:selected").val();
        var to = $("#to option:selected").val();
        var alphabetical = $("#alphabetical").val();
        var date = $("#date").val();
  
        $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: "GET",
        url:    "/search",
        dataType: "text json",
        data: {city_from:from, city_to:to, alphabetical:alphabetical, date:date},
        success: function(data){
            console.log(data);
            $(".results").html("");
            $(".results").append(data);
        }
        });
    })
    Reserve();
 });
 function Pagnation(){
    $(".page-link").click(function(ev){
        ev.preventDefault();  
        var from = $("#from option:selected").val();
        var to = $("#to option:selected").val();
        var alphabetical = $("#alphabetical").val();
        var date = $("#date").val();
        var page = $(this).attr('href').split('page=')[1];
        //alert(page);
        $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: "GET",
        url:    "/search?page="+page,
        dataType: "text json",
        data: {city_from:from, city_to:to, alphabetical:alphabetical, date:date},
        success: function(data){
            console.log(data);
            $(".results").html("");
            $(".results").append(data);
        }
        });
    })
 }
 function Reserve(){
        $(".reserve").click(function(ev){
            ev.preventDefault();  
            var plan_id = $(this).val();
            var street = $('#street'+plan_id).val();

            $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: "POST",
            url:    "/reservation",
            data: {plan_id:plan_id, street: street},
            success: function(data){
                $(".added").html(data);
                $(".added").fadeIn(500);
                $(".added").fadeOut(1500);
            }
            });
        })
    }
</script>
<div class="container-fluid">
    <div class="row ">
        <div class="col-lg-10 col-md-12">
            <div class="card">
                <div class="card-header">
                    <nav class="navbar">
                        <ul class="navbar-nav mr-auto">
                            <span class="navbar-brand">Planovi (rute)</span>
                        </ul>
                        <ul class="navbar-nav ml-auto">
                            @can('create', App\Plan::class)
                                <a href="/plan/create" class="btn btn-primary">Novi plan</a>
                            @endcan
                        </ul>
                    </nav>
                </div>
                <div class="card-body">
                <form action="/search" method="GET">
                    @csrf
                        <nav class="navbar">

                            <div class="mr-2">
                                <label for="price">Od: </label>
                                <select name="city_from" id="from">
                                <option value="0"></option>
                                @foreach ($cities as $city)
                                    <option value="{{$city->id}}">{{$city->name}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="mr-4">
                                <label for="price">Do: </label>
                                <select name="city_to" id="to">
                                <option value="0"></option>
                                @foreach ($cities as $city)
                                    <option value="{{$city->id}}">{{$city->name}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="mr-4">
                                <label for="price">Dan: </label>
                                <input type="date" name="date" id="date">
                            </div>
                            <div class="mr-4">
                                <label for="price">Cena: </label>
                                <select name="alphabetical" id="alphabetical">
                                    <option value="1"></option>
                                    <option value="1">Rastuce</option>
                                    <option value="2">Opadajuce</option>
                                </select>
                            </div>
                            <div>
                                <button style="width:70px" class="btn search" type="submit">Search</button>
                            </div>
                        </nav>
                    </form>
                    <div class="results">
                        <table class="table table-striped table-hover table-fixe"> 
                            <tr>
                                <th scope="col">Od</th>
                                <th scope="col">Do</th>
                                <th scope="col">Polazak</th>
                                <th scope="col">Dolazak</th>
                                <th scope="col">Datum</th>
                                <th scope="col">Cena</th>
                                <th scope="col">Slobodno</th>
                                <th scope="col"></th>
                            </tr>
                        @foreach ($plans as $plan)
                            <tr>
                                <td>{{ $plan->city_from->name }}</td>
                                <td>{{ $plan->city_to->name }}</td>
                                <td>
                                <select name="street" id="street{{$plan->id}}">
                                    @foreach($cities[$plan->city_id_to-1]->streets as $street)
                                        <option value="{{$street->name}}">{{$street->name}}</option>      
                                    @endforeach
                                </select>
                                </td>
                                <td>{{ $plan->price }}</td>
                                <td>{{ $plan->space }}</td>
                                <td>{{ $plan->time_start }}</td>
                                <td>{{ $plan->time_end }}</td>
                                <td>{{ $plan->date }}</td>
                                <td>{{ $plan->price }}</td>

                                <td>
                                    <div class="row">
                                        <div class="col">
                                            <form action="{{url('reservation')}}" method="POST">
                                            @csrf
                                                <input type="hidden" name="plan_id" value="{{$plan->id}}">
                                                <button style="width:75px" class="reserve btn btn-success" type="submit" value="{{$plan->id}}">reserve</button>
                                            </form>
                                            @can('update',$plan)
                                                <button style="width:45px" class="btn btn-secondary" href="plan/{{$plan->id}}/edit">
                                                    <img width="15px" height="15px" src="{{ asset('svg/pencil.svg') }}">
                                                </button>
                                            @endcan
                                        </td>
                                    </td>
                                </td>
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