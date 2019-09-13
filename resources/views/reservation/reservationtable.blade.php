<script>
$(function(){
    Pagnation();
})
</script>
@if(Auth::user()->isAdmin())
<table class="table table-striped table-hover">
    <tr>
        <th scope="col">Korisnik</th>
        <th scope="col">Startna lokacija</th>
        <th scope="col">Destinacija</th>
        <th scope="col">Zaduzenje</th>
        <th scope="col"></th>
    </tr>
    @foreach($reservations as $reservation)
        @can('view', $reservation)
            <tr>
                <td>{{$reservation->user->firstname}} {{$reservation->user->lastname}}</td>
                <td>{{$reservation->plan->city_from->name}}, {{$reservation->start_location}}</td>
                <td>{{$reservation->plan->city_to->name}}, {{$reservation->destination}}</td>
                <td>@if($reservation->schedule_id == null) Nije rasporedjen @else {{$reservation->schedule->driver->firstname}} {{$reservation->schedule->driver->lastname}} @endif</td>
            @can('create', $reservation)
                <td>
                    <div class="row">
                        <div class="col">
                            <a class="mr-2" href="/reservation/{{$reservation->id}}/edit">
                                <img width="15px" height="15px" src="{{ asset('svg/pencil.svg') }}">
                            </a>
                            <a class="mr-2" href="{{url('reservation/'.$reservation->id)}}" onclick="event.preventDefault(); $('#delete-form{{$reservation->id}}').submit()">
                                <img width="15px" height="15px" src="{{ asset('svg/minus.svg') }}">
                            </a>  
                        </div>
                        <form id="delete-form{{$reservation->id}}" action="/reservation/{{$reservation->id}}" method="POST">
                            @method('DELETE')
                            @csrf
                        </form>
                    </div>
                </td>
            @endcan
            </tr>
        @endcan
    @endforeach 
</table>
@endif
@if(Auth::user()->isClient())
<table class="table table-striped table-hover">
    <tr>
        <th scope="col">Startna lokacija</th>
        <th scope="col">Destinacija</th>
        <th scope="col">Datim i vreme</th>
        <th scope="col">Vozilo</th>
        <th scope="col">Telefon vozaca</th>
    </tr>
    @foreach($reservations as $reservation)
        @can('view', $reservation)
            <tr>
                <td>{{$reservation->plan->city_from->name}}, {{$reservation->start_location}}</td>
                <td>{{$reservation->plan->city_to->name}}, {{$reservation->destination}}</td>
                <td>{{$reservation->plan->date}} {{$reservation->plan->time_start}}</td>
                <td>@if($reservation->schedule_id == null) <p class="text-danger">Čeka se rasporedjivanje</p> @else {{$reservation->schedule->vehicle->plate_number}} {{$reservation->schedule->vehicle->model}}  @endif</td>
                <td>@if($reservation->schedule_id == null) <p class="text-danger">Čeka se rasporedjivanje</p> @else {{$reservation->schedule->driver->phone_number}} @endif</td>
            @can('create', $reservation)
                <td>
                    <div class="row">
                        <div class="col">
                            <a class="mr-2" href="/reservation/{{$reservation->id}}/edit">
                                <img width="15px" height="15px" src="{{ asset('svg/pencil.svg') }}">
                            </a>
                            <a class="mr-2" href="{{url('reservation/'.$reservation->id)}}" onclick="event.preventDefault(); $('#delete-form{{$reservation->id}}').submit()">
                                <img width="15px" height="15px" src="{{ asset('svg/minus.svg') }}">
                            </a>  
                        </div>
                        <form id="delete-form{{$reservation->id}}" action="/reservation/{{$reservation->id}}" method="POST">
                            @method('DELETE')
                            @csrf
                        </form>
                    </div>
                </td>
            @endcan
            </tr>
        @endcan
    @endforeach 
</table>
@endif
{{$reservations->links()}}