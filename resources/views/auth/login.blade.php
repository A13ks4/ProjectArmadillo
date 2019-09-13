@extends('layouts.welcomeapp')

@section('content')
<div class="row my-5">
    <div id="col" class="col-md align-self-center">
        <div class="col-sm-10 col-md-10 col-lg-6 mx-auto">
            <div class="card card-signin" >
                <div class="card-body">
                    <h5 class="card-title text-center"><a href="{{ url('/') }}"><img width="60px" height="80px" src="{{ asset('img/logo.png') }}" alt="error"></a></h5>
                    <hr class="my-4">
                    <div class="row justify-content-md-center">
                        <div class="col-auto">
                            <div class="card-header">{{ __('Prijavite se na sistem') }}</div>
                        </div>
                    </div>
                    <form class="form-signin" method="POST" action="{{ route('login') }}">
                    @csrf
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
                        <div class="row justify-content-md-center">
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Prijava') }}
                                </button>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="col">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">
                                    {{ __('Zaboravili ste lozinku?') }}
                                </a>
                            @endif
                            <p>Nemate nalog? <a href="{{ route('register') }}">Registrujte se</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection('content')