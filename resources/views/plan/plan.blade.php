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
            //console.log(data);
            $(".results").html("");
            $(".results").append(data);
        }
        });
    })
    
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
            //console.log(data);
            $(".results").html("");
            $(".results").append(data);
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
                                <button style="width:75px" class="btn search" type="submit">Pretraži</button>
                            </div>
                        </nav>
                    </form>
                    <div class="results">
                        @include('pagination')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="added" style="background:green; display:none; border: 1px solid black; position:absolute; bottom:0; right:0; width: 200px; ">Reserved</div>
@endsection