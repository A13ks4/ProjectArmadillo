<script>
$(function(){
    Reserve();
    Pagnation();
});
</script>
<table class="table table-striped table-hover">
<tr><td>City from:</td><td>City to:</td><td>Price:</td><td>Time start:</td><td>Time end:</td></tr>
    @foreach ($plans as $plan)
                           
    <tr><td>{{ $plan->city_from->name }}</td>
    <td>{{ $plan->city_to->name }}</td>
    <td>{{ $plan->price }}</td>
    <td>{{ $plan->time_start }}</td>
    <td>{{ $plan->time_end }}</td>
    <td>{{ $plan->date }}</td>
    <td> <form action="{{url('reservation')}}" method="POST">
    @csrf
        
        <input type="hidden" name="plan_id" value="{{$plan->id}}">
        <button class="reserve" type="submit" value="{{$plan->id}}">reserve</button>
    </form>
    </td>
    @can('update',$plan)
    <td><a href="plan/{{$plan->id}}/edit">edit</a></td>
    @endcan
    </tr>
@endforeach
</table>
{{ $plans->links() }}
