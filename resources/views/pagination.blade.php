<script>
$(function(){
    Reserve();
    Pagnation();
});
</script>
<table class="table table-striped table-hover table-fixe"> 
    <tr>
        <th scope="col">Od</th>
        <th scope="col">Do</th>
        <th scope="col">Polazak</th>
        <th scope="col">Dolazak</th>
        <th scope="col">Datum</th>
        <th scope="col">Cena</th>
        <th scope="col">Slobodno</th>
        <th scope="col"></th>
    </tr>
@foreach ($plans as $plan)
    <tr>
        <td>{{ $plan->city_from->name }}</td>
        <td>{{ $plan->city_to->name }}</td>
        <td>{{ $plan->time_start }}</td>
        <td>{{ $plan->time_end }}</td>
        <td>{{ $plan->date }}</td>
        <td>{{ $plan->price }}</td>
        <td>{{ $plan->space }}</td>
        <td>
            <div class="row">
                <div class="col">
                    @can('reserve', App\Reservation::class)
                    <form action="{{url('reservation')}}" method="POST">
                    @csrf
                        <input type="hidden" name="plan_id" value="{{$plan->id}}">
                        <button style="width:100px;" class="reserve btn btn-success py-1" type="submit" value="{{$plan->id}}">Rezervišite</button>
                    </form>
                    @endcan
                    @can('update',$plan)
                    <a class="mr-2" href="/plan/{{$plan->id}}/edit">
                        <img width="15px" height="15px" src="{{ asset('svg/pencil.svg') }}">
                    </a>
                    @endcan
                </td>
            </td>
        </td>
    </tr>
@endforeach
</table>
{{$plans->links()}}