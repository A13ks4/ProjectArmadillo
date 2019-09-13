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
        url:    "/reservation?page="+page,
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
                            <span class="navbar-brand">Rezervacije</span>
                        </ul>
                        @if(Auth::user()->isAdmin() || Auth::user()->isDriver())
                            <a href="{{ url('reservation/pdf') }}">Download PDF </a>&nbsp; | &nbsp;
                            <a href="{{ url('reservation/word') }}"> Download Word</a>
                        @endif
                    </nav>
                </div>
                <div class="card-body">
                    <div class="results">
                        @include('reservation/reservationtable')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 