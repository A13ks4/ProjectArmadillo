@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8 col-lg-6">
            <div class="card">
                <div class="card-header">Stanje</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span>Reg. klijenata:
                            <h2>{{$users}}</h2>
                        </div>
                        <div class="col">
                            <span>Broj zaposlenih:</span>
                            <h2>{{$drivers}}</h2>
                        </div>
                        <div class="col">
                            <span>Broj vozila:</span>
                            <h2>{{$vehicles}}</h2>
                        </div>
                        <div class="col">
                            <span>Ukupno sedišta:</span>
                            <h2>{{$seats}}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Usluga dostupna u {{$cities->count()}} gradova.</div>
                <div class="card-body">
                    <?php $i = 0; ?>
                    @foreach($cities as $city)
                        {{++$i}}. {{$city->name}} <br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
