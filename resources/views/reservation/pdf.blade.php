<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    
    <!-- Styles -->
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
    table{
        margin-top:100px;
    }
    body {
        font-family: DejaVu Sans;
    }
    </style>
</head>
<body>
    <div id="app">
        <div class="row no-gutters">         
            <div class="col">
                <main class="py-4">
                    <div class="container-fluid">
                        <div class="row ">
                            <div class="col-lg-10 col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <nav class="navbar">
                                            
                                                <h1>Rezervacije</h1>
                                            
                                            
                                        </nav>
                                    </div>
                                    <div class="card-body">
                                        <div class="results">
                                        <table class="table table-striped table-hover">
                                            <tr>
                                                <th scope="col">Korisnik</th>
                                                <th scope="col">Startna lokacija</th>
                                                <th scope="col">Destinacija</th>
                                                <th scope="col"></th>
                                            </tr>
                                            
                                            @foreach($reservations as $reservation)
                                                    <tr>
                                                        <td>{{$reservation->user->firstname}} {{$reservation->user->lastname}}</td>
                                                        <td>{{$reservation->plan->city_from->name}}, {{$reservation->start_location}}</td>
                                                        <td>{{$reservation->plan->city_to->name}}, {{$reservation->destination}}</td>
                                                    
                                                    </tr>
                                            @endforeach
                                            
                                        </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</body>
</html>