<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Taksi</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet"/>
        <style>
            #wrapper {
                height: 100vh; 
                width: 100vw;
            }
            html,body {
                height:100%;
                margin:0;
                 
            }
            .column {
                width: 50%;
                height: 100%;
            }
            .column.left {
                float: left;
            }
            .column.right {
                background-image: url('{{ asset('img/welcome.jpg') }}');
                background-repeat: no-repeat;
                background-size: cover;
                background-position: right bottom;
                float: right;
            }
        </style>
    </head>
    <body>
        <div id="wrapper">
            <div class="column left">
                @yield('content')
            </div>
            <div class="column right"></div>
        </div>
    </body>
</html>
