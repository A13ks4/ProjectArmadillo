@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit City</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div>
                    <form action="/city" method="POST">
                    @csrf
                    
                        <span>City Name:</span>
                       
                       <input type="text" class="form-control" name="cityName" ><br>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    </div>
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection