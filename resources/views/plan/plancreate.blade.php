@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Plan</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div>
                        <span>Plans go here</span>
                        <form action="/plan" method="POST">
                        @csrf
                    
                            <span>Plan Name:</span>
                       
                            <input type="text" class="form-control" name="planName" ><br>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                            
                    </div>
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection