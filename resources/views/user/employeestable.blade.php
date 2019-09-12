<script>
$(function(){
    Pagnation();
})
</script>
 <table class="table table-striped table-hover">
                        <tr>
                            <th scope="col">#id</th>
                            <th scope="col">Slika</th>
                            <th scope="col">Ime</th>
                            <th scope="col">Prezime</th>
                            <th scope="col">Telefon</th>
                            <th scope="col">E-mail</th>
                            <th scope="col"></th>
                        </tr>
                    @if ($employees->isEmpty())
                        
                    @else
                        @foreach($employees as $employee)
                            <tr>
                                <td>{{$employee->id}}</td>
                                <td><img class="rounded-circle" width="35px" height="35px" src="{{$employee->img}}" alt="none"></td>
                                <td>{{$employee->firstname}}</td>
                                <td>{{$employee->lastname}}</td>
                                <td>{{$employee->phone_number}}</td>
                                <td>{{$employee->email}}</td>
                            @can('create', $employee)
                                <td>
                                    <div class="row">
                                        <div class="col">
                                            <a class="mr-2" href="#" onclick="user = {{$employee}}; showpopup()">
                                                <img width="15px" height="15px" src="{{ asset('svg/eye.svg') }}">
                                            </a>
                                            <a class="mr-2" href="/user/{{$employee->id}}/edit">
                                                <img width="15px" height="15px" src="{{ asset('svg/pencil.svg') }}">
                                            </a>
                                            <a class="mr-2" href="{{url('user/'.$employee->id)}}" onclick="event.preventDefault(); $('#delete-form').submit()">
                                                <img width="15px" height="15px" src="{{ asset('svg/minus.svg') }}">
                                            </a>
                                        </div>
                                        <form id="delete-form" action="/user/{{$employee->id}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                    </div>
                                </td>
                            @endcan
                            </tr>
                        @endforeach
                    @endif
                    </table>
                    {{$employees->links()}}