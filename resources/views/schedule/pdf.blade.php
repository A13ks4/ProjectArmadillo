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
                                <h1>Zaduzenja</h1>
                            </nav>
                </div>
                <div class="card-body"><div class="results">
                    <table class="table table-striped table-hover">
                        <tr>
                            <th scope="col">Vozac:</th>
                            <th scope="col">Plan:</th>
                            <th scope="col">Vozilo:</th>
                            
                        </tr>
                        @foreach($schedules as $schedule)
                            
                                <tr>
                                    <td><img class="rounded-circle mr-2" width="35px" height="35px" src="{{$schedule->driver->img}}" alt="none"> {{$schedule->driver->firstname}} {{$schedule->driver->lastname}}</td>
                                    <td>{{$schedule->plan->city_from->name}} - {{$schedule->plan->city_to->name}}, {{$schedule->plan->date}} {{date('g:ia', strtotime($schedule->plan->time_start))}}</td>
                                    <td>{{$schedule->vehicle->brand}} {{$schedule->vehicle->model}}</td> 
                                   
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