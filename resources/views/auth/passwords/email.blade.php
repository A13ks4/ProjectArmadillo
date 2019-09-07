@extends('layouts.welcomeapp')

@section('content')
<div class="row my-5">
    <div id="col" class="col-md align-self-center">
        <div class="col-sm-10 col-md-8 col-lg-6 mx-auto">
            <div class="card card-signin my-5" >
                <div class="card-body">
                    <h5 class="card-title text-center"><a href="{{ url('/') }}"><img width="60px" height="80px" src="{{ asset('img/logo.png') }}" alt="error"></a></h5>
                    <hr class="my-4">
                    <div class="row justify-content-md-center">
                        <div class="col-auto">
                            <div class="card-header">{{ __('Resetovanje lozinke') }}</div>
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
                        <div class="row justify-content-md-center">
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Posalji link') }}
                                </button>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="col">
                            <p>Nemate nalog? <a href="{{ route('register') }}">Registrujte se</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

                

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        
                    </form>
                </div>

@endsection('content')
