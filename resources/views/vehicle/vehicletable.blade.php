<script>
$(function(){
    Pagnation();
})
</script>
<table class="table table-striped table-hover">
    <tr>
        <th scope="col"></th>
        <th scope="col">Br. reg-tablica</th>
        <th scope="col">Brend</th>
        <th scope="col">Model</th>
        <th scope="col">Boja</th>
        <th scope="col">Br. sedišta</th>
        <th scope="col"></th>
    </tr>
    @foreach($vehicles as $vehicle)
        <tr>
            <td class="text-center"><img class="rounded-circle" width="35px" height="35px" src="{{$vehicle->img}}" alt="none"></td>
            <td>{{$vehicle->plate_number}}</td>
            <td>{{$vehicle->brand}}</td>
            <td>{{$vehicle->model}}</td>
            <td>{{$vehicle->color}}</td>
            <td class=" " >{{$vehicle->seats_number}}</td>
        @can('create', $vehicle)
            <td>
                <div class="row">
                    <div class="col">
                        <a class="mr-2" href="#" onclick="vehicle = {{$vehicle}}; showpopup()">
                            <img width="15px" height="15px" src="{{ asset('svg/eye.svg') }}">
                        </a>
                        <a class="mr-2" href="/vehicle/{{$vehicle->id}}/edit">
                            <img width="15px" height="15px" src="{{ asset('svg/pencil.svg') }}">
                        </a>
                        <a class="mr-2" href="{{url('vehicle/'.$vehicle->id)}}" onclick="event.preventDefault(); $('#delete-form{{$vehicle->id}}').submit()">
                            <img width="15px" height="15px" src="{{ asset('svg/minus.svg') }}">
                        </a>  
                    </div>
                    <form id="delete-form{{$vehicle->id}}" action="/vehicle/{{$vehicle->id}}" method="POST">
                        @method('DELETE')
                        @csrf
                    </form>
                </div>
            </td>
        @endcan
        </tr>
    @endforeach 
</table>

{{$vehicles->links()}}