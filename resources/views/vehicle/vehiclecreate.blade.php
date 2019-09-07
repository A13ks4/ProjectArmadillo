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
                        <span>Create street</span>
                        <form action="/vehicle" method="POST">
                        @csrf
                    
                            <span>Vehicle Brand:</span>
                            <input type="text" class="form-control" name="brand" ><br>
                            <span>Vehicle Model:</span>
                            <input type="text" class="form-control" name="model" ><br>
                            <span>Vehicle color:</span>
                            <input type="text" class="form-control" name="color" ><br>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                            
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection