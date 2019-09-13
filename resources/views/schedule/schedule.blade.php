@extends('layouts.app')

@section('content')
<script>
 function Pagnation(){
    $(".page-link").click(function(ev){
        ev.preventDefault();  
        
        var page = $(this).attr('href').split('page=')[1];
        
        $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: "GET",
        url:    "/schedule?page="+page,
        dataType: "text json",
        
        success: function(data){
            
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
                            <span class="navbar-brand">Zaduzenja</span>
                        </ul>
                        
                        <ul class="navbar-nav ml-auto">
                            @can('create', App\Schedule::class)
                            <div class="row">
                                <a class="mr-4 mt-2" href="{{ url('schedule/pdf') }}">Download PDF</a>
                                <a href="/schedule/create" class="btn btn-primary">Novo zaduzenje</a>
                            </div>
                            @endcan
                        </ul>
                    </nav>
                </div>
                <div class="card-body"><div class="results">@include('schedule/scheduletable')</div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 