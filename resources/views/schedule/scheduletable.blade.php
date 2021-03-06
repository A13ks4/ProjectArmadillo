<script>
$(function(){
    Pagnation();
})
</script>
@if(Auth::user()->isAdmin())
<table class="table table-striped table-hover">
    <tr>
        <th scope="col">Vozac:</th>
        <th scope="col">Plan:</th>
        <th scope="col">Vozilo:</th>
        <th scope="col"></th>
        <th scope="col"></th>
    </tr>
    @foreach($schedules as $schedule)
        @can('view', $schedule)
            <tr>
                <td><img class="rounded-circle mr-2" width="35px" height="35px" src="{{$schedule->driver->img}}" alt="none"> {{$schedule->driver->firstname}} {{$schedule->driver->lastname}}</td>
                <td>{{$schedule->plan->city_from->name}} - {{$schedule->plan->city_to->name}}, {{$schedule->plan->date}} {{date('g:ia', strtotime($schedule->plan->time_start))}}</td>
                <td>{{$schedule->vehicle->brand}} {{$schedule->vehicle->model}}</td> 
                @can('create', $schedule)
                    <td>
                        <div class="row">
                            <div class="col">
                                <a class="mr-2" href="/schedule/{{$schedule->id}}/edit">
                                    <img width="15px" height="15px" src="{{ asset('svg/pencil.svg') }}">
                                </a>
                                <a class="mr-2" href="{{url('schedule/'.$schedule->id)}}" onclick="event.preventDefault(); $('#delete-form{{$schedule->id}}').submit()">
                                    <img width="15px" height="15px" src="{{ asset('svg/minus.svg') }}">
                                </a>  
                            </div>
                            <form id="delete-form{{$schedule->id}}" action="/schedule/{{$schedule->id}}" method="POST">
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
@if(Auth::user()->isDriver())
<table class="table table-striped table-hover">
    <tr>
        <th scope="col">Datum i vreme:</th>
        <th scope="col">Plan:</th>
        <th scope="col">Vozilo:</th>
    </tr>
    @foreach($schedules as $schedule)
        @can('view', $schedule)
            <tr>
                <td>{{$schedule->plan->date}} {{date('g:ia', strtotime($schedule->plan->time_start))}}</td>
                <td>{{$schedule->plan->city_from->name}} - {{$schedule->plan->city_to->name}}</td>
                <td>{{$schedule->vehicle->plate_number}} {{$schedule->vehicle->brand}} {{$schedule->vehicle->model}}</td> 
                @can('create', $schedule)
                    <td>
                        <div class="row">
                            <div class="col">
                                <a class="mr-2" href="/schedule/{{$schedule->id}}/edit">
                                    <img width="15px" height="15px" src="{{ asset('svg/pencil.svg') }}">
                                </a>
                                <a class="mr-2" href="{{url('schedule/'.$schedule->id)}}" onclick="event.preventDefault(); $('#delete-form{{$schedule->id}}').submit()">
                                    <img width="15px" height="15px" src="{{ asset('svg/minus.svg') }}">
                                </a>  
                            </div>
                            <form id="delete-form{{$schedule->id}}" action="/schedule/{{$schedule->id}}" method="POST">
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
{{$schedules->links()}}