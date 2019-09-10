@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-5 col-md-8">
            <div class="card">
                <div class="card-header">Novo vozilo</div>
                <div class="card-body">
                    <form action="/vehicle" method="POST">
                    @csrf
                        <span>Br. reg-tablica:</span>
                        <input type="text" class="form-control" name="plate_number" ><br>
                        <span>Brend:</span>
                        <input type="text" class="form-control" name="brand" ><br>
                        <span>Model:</span>
                        <input type="text" class="form-control" name="model" ><br>
                        <span>Boja:</span>
                        <input type="text" class="form-control" name="color" ><br>
                        <span>Br. sedista:</span>
                        <input type="number" value="2" class="form-control" name="seats_number" ><br>
                        <span>Slika:</span> <!-- Ili link do slike nzm sta cemo -->
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="fileInput" onChange="test()" aria-describedby="inputGroupFileAddon01">
                            <label id="fileInputlabel" class="custom-file-label" for="inputGroupFileAddon01">Izaberi fajl</label>
                        </div> <br> <br>
                        <div class="row justify-content-center">
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Dodaj vozilo') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function test() { 
        var s = document.getElementById('fileInput').value;
        var t = "...";
        if (s.length > 25) {
            t += s.substring(11, 25) + "..."; 
        } else {
            t += s.substring(11, s.length); 
        }
        document.getElementById('fileInputlabel').innerHTML = 'Izabran fajl: ' + t;
    };
</script>
@endsection