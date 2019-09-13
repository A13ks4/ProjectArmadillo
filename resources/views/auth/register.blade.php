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
                            <div class="card-header">{{ __('Registrujte se') }}</div>
                        </div>
                    </div>
                    <form class="form-signin" method="POST" action="{{ route('register') }}">
                    @csrf
                        <div class="form-label-group">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <label for="name">Ime</label>
                        </div>
                        <div class="form-label-group">
                            <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>
                            @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <label for="lastname">Prezime</label>
                        </div>
                        <div class="form-label-group">
                            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <label for="email">Email adresa</label>
                        </div>
                        <div class="form-label-group">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password" autofocus>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <label for="password">Lozinka</label>
                        </div>
                        <div class="form-label-group">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            <label for="password-confirm">Ponovite lozinku</label>
                        </div>
                        <div class="row justify-content-md-center">
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registracija') }}
                                </button>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="col">
                            <p>Imate nalog? <a href="{{ route('login') }}">Prijavite se</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection('content')