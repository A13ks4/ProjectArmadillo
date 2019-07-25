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
                        <form action="/street" method="POST">
                        @csrf
                    
                            <span>Street Name:</span>
                       
                            <input type="text" class="form-control" name="streetName" ><br>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                            
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection