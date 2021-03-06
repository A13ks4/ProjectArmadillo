@extends('layouts.app')

@section('content')
<script>
$(function(){
    Reserve();
});
 function Reserve(){
        $(".reserve").click(function(ev){
            ev.preventDefault();  
            var plan_id = $('#plan_id').val();
            var start_location = $('#start_location').val();
            var destination = $('#destination').val();

            $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: "POST",
            url:    "/reservation",
            data: {plan_id:plan_id, start_location: start_location, destination:destination},
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
    <div class="row">
        <div class="col-lg-5 col-md-8">
            <div class="card">
                <div class="card-header">Rezervacija</div>
                <div class="card-body">
                    <form action="/reservation" enctype="multipart/form-data" method="POST">
                    @csrf
                        <span>Od:</span> <br>
                        <input type="number" class="form-control" id="plan_id" name="plan_id" value="{{ $plan->id }}" readonly hidden>
                        <input type="text" class="form-control" value="{{ $plan->city_from->name }}" readonly><br>
                        <span>Polazna ulica:</span> <br>
                        <select class="form-control" name="start_location" id="start_location">
                            @foreach($plan->city_from->streets as $street)
                                <option value="{{$street->name}}">{{$street->name}}</option>
                            @endforeach
                        </select><br>
                        <span>Do:</span> <br>
                        <input type="text" class="form-control" value="{{ $plan->city_to->name }}" readonly><br>
                        <span>Destinacija</span> <br>
                        <select class="form-control" name="destination" id="destination">
                            @foreach($plan->city_to->streets as $street)
                                <option value="{{$street->name}}">{{$street->name}}</option>
                            @endforeach
                        </select><br>
                        <span>Datum:</span> <br>
                        <input type="text" class="form-control" value="{{ $plan->date }}" readonly><br>
                        <span>Vreme polaska:</span> <br>
                        <input type="text" class="form-control" value="{{ $plan->time_start }}" readonly><br>
                        <span>Vreme dolaska:</span> <br>
                        <input type="text" class="form-control" value="{{ $plan->time_end }}" readonly><br><br>
                        <span>Cena:</span> <br>
                        <input type="text" class="form-control" value="{{ $plan->price }}" readonly><br><br>
                        <div class="row justify-content-center">
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary reserve">
                                    {{ __('Rezervisite') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="added">
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection