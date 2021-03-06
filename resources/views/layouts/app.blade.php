<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/popup.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div style="position: relative; z-index:1;" class="row no-gutters">
            <div id="sidebar">
                <div class="bg-light">
                    <div class="row mt-4 mb-4">
                        <div class="col text-center">
                            <a class="navbar-brand" href="{{ url('/') }}"><img id="logo" width="55px" height="70px" src="{{ asset('img/logo.png') }}" alt="error"></a>
                        </div>
                    </div>
                    <div class="list-group list-group-flush collapse show" id="navbarSupportedContent">
                        <div class="row">
                            <div class="col">
                                <a href="{{ url('/home') }}" class="list-group-item list-group-item-action bg-light">
                                    <img class="mr-2 mb-1" width="20px" height="20px" src="{{ asset('svg/home.svg') }}">
                                    <span style="sb-show">Pocetna</span>
                                </a>
                                @if (Auth::user()->can('create', App\Vehicle::class))
                                <a href="{{ url('/vehicle') }}" class="list-group-item list-group-item-action bg-light">
                                    <img class="mr-2 mb-1" width="20px" height="20px" src="{{ asset('svg/car.svg') }}">
                                    <span style="sb-show">Vozila</span>
                                </a>
                                @endif
                                @if (Auth::user()->can('create', App\Plan::class))
                                <a href="{{ url('/plan') }}" class="list-group-item list-group-item-action bg-light">
                                    <img class="mr-2 mb-1" width="20px" height="20px" src="{{ asset('svg/map-marker.svg') }}">
                                    <span style="sb-show">Planovi</span>
                                </a>
                                @endif
                                @if (Auth::user()->isClient())
                                <a href="{{ url('/plan') }}" class="list-group-item list-group-item-action bg-light">
                                    <img class="mr-2 mb-1" width="20px" height="20px" src="{{ asset('svg/clock.svg') }}">
                                    <span style="sb-show">Rezervisite voznju</span>
                                </a>
                                @endif
                                @if (Auth::user()->isClient())
                                <a href="{{ url('/reservation') }}" class="list-group-item list-group-item-action bg-light">
                                    <img class="mr-2 mb-1" width="20px" height="20px" src="{{ asset('svg/book.svg') }}">
                                    <span style="sb-show">Vase rezervacije</span>
                                </a>
                                @endif
                                @if (Auth::user()->can('create', App\User::class))
                                <a href="{{url('employees')}}" class="list-group-item list-group-item-action bg-light">
                                    <img class="mr-2 mb-1" width="20px" height="20px" src="{{ asset('svg/employee.svg') }}">
                                    <span style="sb-show">Zaposleni</span>
                                </a>
                                @endif
                                @if (Auth::user()->can('see', App\Schedule::class))
                                <a href="{{url('/schedule')}}" class="list-group-item list-group-item-action bg-light">
                                    <img class="mr-2 mb-1" width="20px" height="20px" src="{{ asset('svg/briefcase.svg') }}">
                                    <span style="sb-show">Zaduzenja</span>
                                </a>
                                @endif
                                @if (Auth::user()->can('create', App\User::class))
                                <a href="{{ url('/user') }}" class="list-group-item list-group-item-action bg-light">
                                    <img class="mr-2 mb-1" width="20px" height="20px" src="{{ asset('svg/person.svg') }}">
                                    <span style="sb-show">Klijenti</span>
                                </a>
                                @endif
                                @if (Auth::user()->isAdmin() || Auth::user()->isDriver())
                                <a href="{{url('/reservation')}}" class="list-group-item list-group-item-action bg-light">
                                    <img class="mr-2 mb-1" width="20px" height="20px" src="{{ asset('svg/book.svg') }}">
                                    <span style="sb-show">Rezervacije</span>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <nav class="navbar navbar-expand navbar-light bg-white shadow-sm">
                    <div class="container-fluid">
                        <button class="pl-0" id="sidebutton" onclick="openclosesidebar();">
                            <img class="mr-2 mb-1" width="20px" height="20px" src="{{ asset('svg/menu.svg') }}">
                        </button>
                        <ul class="navbar-nav ml-auto">
                            <div class="row ml-auto mr-4">
                                <img class="rounded-circle" width="35px" height="35px" src="@if(Auth::user()->isImgLocal()) ../../{{Auth::user()->img}} @else {{Auth::user()->img}} @endif" alt="">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle ml-2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}<span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        
                                        <a class="dropdown-item" href="/user/{{Auth::user()->id}}/edit">
                                            {{ __('Profil') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                            {{ __('Odjavite se') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </div>
                        </ul>
                    </div>
                </nav>
                <main class="py-4">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
</body>
<script>
    var isOpened = false;
    function openclosesidebar() {
        if (!isOpened) {
            document.getElementById('sidebar').style.display = 'block';
            document.getElementById('sidebutton').style.marginLeft = '230px';
            isOpened = true;
        } else {
            document.getElementById('sidebar').style.display = 'none';
            document.getElementById('sidebutton').style.marginLeft = '0px';
            isOpened = false;
        }
    }
    function sidebarfix(x) {
        if (x.matches) {
            document.getElementById('sidebar').style.display = 'block';
            document.getElementById('sidebutton').style.marginLeft = '230px';
            isOpened = true;
        }
    }
    var x = window.matchMedia("(max-width: 700px)");
    sidebarfix(x);
    x.addListener(sidebarfix);
</script>
</html>
