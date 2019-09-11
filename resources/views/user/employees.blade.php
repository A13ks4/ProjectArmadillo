@extends('layouts.app')

@section('content')
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
                    <table class="table table-striped table-hover">
                        <tr>
                            <th scope="col">#id</th>
                            <th scope="col">Slika</th>
                            <th scope="col">Ime</th>
                            <th scope="col">Prezime</th>
                            <th scope="col">Telefon</th>
                            <th scope="col">E-mail</th>
                            <th scope="col"></th>
                        </tr>
                    @foreach($employees as $employee)
                        
                        <tr>
                            <td>{{$employee->id}}</td>
                            <td><img class="rounded-circle" width="35px" height="35px" src="{{$employee->img}}" alt="none"></td>
                            <td>{{$employee->firstname}}</td>
                            <td>{{$employee->lastname}}</td>
                            <td>{{$employee->phone_number}}</td>
                            <td>{{$employee->email}}</td>
                        @can('create', $employee)
                            <td>
                                <div class="row">
                                    <div class="col">
                                        <a href="#" onclick="user = {{$employee}}; showpopup()">
                                            <img width="15px" height="15px" src="{{ asset('svg/eye.svg') }}">
                                        </a>
                                        <a href="/user/{{$employee->id}}/edit">
                                            <img width="15px" height="15px" src="{{ asset('svg/pencil.svg') }}">
                                        </a>
                                    </div>
                                    <div class="col">
                                        <form action="/user/{{$employee->id}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <a href="{{url('user/'.$employee->id)}}" onclick="event.preventDefault(); 
                                                            $('#delete-form').submit()">
                                                <img width="15px" height="15px" src="{{ asset('svg/minus.svg') }}">
                                            </a>
                                        </form>
                                    </div>
                                    <form id="delete-form" action="/user/{{$employee->id}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                </div>
                            </td>
                        @endcan
                        </tr>
                       
                    @endforeach 
                    </table>
                    {{$employees->links()}}
                    <div id="popup" class="modal container">
                        <div class="modal-content animate">
                            <div class="imgcontainer">
                                <span onclick="document.getElementById('popup').style.display='none'" class="close" title="Close Modal">&times;</span>
                                <img id="popupimg" width="280px" height="280px" src="" alt="none" class="rounded-circle">
                            </div>
                            <div class="container">
                                <div class="text-center mb-4">
                                    <h3 id="popupbrand"></h3>
                                    <h5 id="popupmodel"></h2>
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
        document.getElementById('popupbrand').innerHTML = user.firstname + " " + user.lastname;
        document.getElementById('popupmodel').innerHTML = user.lastname;
    }
</script>