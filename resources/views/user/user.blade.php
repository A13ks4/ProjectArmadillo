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
        url:    "/user?page="+page,
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
                            <span class="navbar-brand">Klijenti</span>
                        </ul>
                    </nav>
                </div>
                <div class="card-body">
                    <div class="results">@include('user/usertable')</div>
                    <div id="popup" class="modal container">
                        <div class="modal-content animate">
                            <div class="imgcontainer">
                                <span onclick="document.getElementById('popup').style.display='none'" class="close" title="Close Modal">&times;</span>
                                <img id="popupimg" width="280px" height="280px" src="" alt="none" class="rounded-circle">
                            </div>
                            <div class="container">
                                <div class="text-center mb-4">
                                    <h3 id="popupname"></h3>
                                    <h5 id="popupemail"></h2>
                                </div>
                                <button onclick="document.getElementById('popup').style.display='none'">Zatvori</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    var user;
    function showpopup() {
        document.getElementById('popup').style.display= 'block';
        document.getElementById('popupimg').src = user.img;
        document.getElementById('popupname').innerHTML = user.firstname + " " + user.lastname;
        document.getElementById('popupemail').innerHTML = user.email;
    }
</script>