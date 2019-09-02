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
                        @can('create', App\Plan::class)<a href="/plan/create" class="btn btn-primary">+</a>@endcan
                        <br>
                        <table class="table table-striped table-hover"> 
                        <tr><td>City from:</td><td>City to:</td><td>Vehicle:</td><td>Time start:</td><td>Time end:</td></tr>
                        @foreach ($plans as $plan)
                           
                            <tr><td>{{ $plan->city_from->name }}</td>
                            <td>{{ $plan->city_to->name }}</td>
                            <td>{{ $plan->vehicle->brand }}</td>
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