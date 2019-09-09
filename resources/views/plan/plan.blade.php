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
    }
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
                            <select name="alphabetical" id="alphabetical">
                                <option value="0"></option>
                                <option value="1">ASC</option>
                                <option value="2">DSC</option>
                            </select>

                            <select name="city_from" id="from">
                           <option value="0"></option>
                            @foreach ($cities as $city)
                                <option value="{{$city->id}}">{{$city->name}}</option>
                            @endforeach
                            </select>
                            <select name="city_to" id="to">
                            <option value="0"></option>
                            @foreach ($cities as $city)
                                <option value="{{$city->id}}">{{$city->name}}</option>
                            @endforeach
                            </select>
                            <input type="date" name="date" id="date">
                            <button class="btn search" type="submit">Search</button>
                        </form>

                        @can('create', App\Plan::class)<a href="/plan/create" class="btn btn-primary">+</a>@endcan
                        <br>
                        <div class="results">
                            <table class="table table-striped table-hover"> 
                            <tr><td>City from:</td><td>City to:</td><td>Price:</td><td>Time start:</td><td>Time end:</td></tr>
                            @foreach ($plans as $plan)
                            
                                <tr><td>{{ $plan->city_from->name }}</td>
                                <td>{{ $plan->city_to->name }}</td>
                                <td>{{ $plan->price }}</td>
                                <td>{{ $plan->time_start }}</td>
                                <td>{{ $plan->time_end }}</td>
                                <td>{{ $plan->date }}</td>
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
                            {{ $plans->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="added" style="background:green; display:none; border: 1px solid black; position:absolute; bottom:0; right:0; width: 200px; ">Reserved</div>

@endsection