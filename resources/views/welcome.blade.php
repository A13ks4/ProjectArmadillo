<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Taksi</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="css/app.css" rel="stylesheet"/>
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
                <div class="container">
                    <div class="row">
                        <div id="col" class="col-md-12 align-self-center">
                            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                                <div class="card card-signin my-5" >
                                    <div class="card-body">
                                        <h5 class="card-title text-center">Medjugradski taksi logo</h5>
                                        <hr class="my-4">
                                        <form class="form-signin" method="POST" action="{{ route('login') }}">
                                            <div class="form-label-group">
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <label for="inputEmail">Email adresa</label>
                                            </div>
                                            <div class="form-label-group">
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <label for="inputPassword">Lozinka</label>
                                            </div>
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="remember">
                                                    {{ __('Zapamti me') }}
                                                </label>
                                            </div>
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Prijava') }}
                                            </button>

                                            @if (Route::has('password.request'))
                                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                                    {{ __('Zaboravili ste lozinku?') }}
                                                </a>
                                            @endif
                                            <hr class="my-4">
                                            <div class="col">
                                                <p>Nemate nalog? <a href="">Registrujte se</a></p>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column right"></div>
        </div>
    </body>
</html>
