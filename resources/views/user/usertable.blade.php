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
                    @foreach($users as $user)
                        @if($user->isClient())
                        <tr>
                            <td>{{$user->id}}</td>
                            <td><img class="rounded-circle" width="35px" height="35px" src="{{$user->img}}" alt="none"></td>
                            <td>{{$user->firstname}}</td>
                            <td>{{$user->lastname}}</td>
                            <td>{{$user->phone_number}}</td>
                            <td>{{$user->email}}</td>
                        @can('create', $user)
                            <td>
                                <div class="row">
                                    <div class="col">
                                        <a class="mr-2" href="#" onclick="user = {{$user}}; showpopup()">
                                            <img width="15px" height="15px" src="{{ asset('svg/eye.svg') }}">
                                        </a>
                                        <a class="mr-2" href="/user/{{$user->id}}/edit">
                                            <img width="15px" height="15px" src="{{ asset('svg/pencil.svg') }}">
                                        </a>
                                        <a class="mr-2" href="#" onclick="event.preventDefault(); $('#delete-form{{$user->id}}').submit()">
                                            <img width="15px" height="15px" src="{{ asset('svg/minus.svg') }}">
                                        </a>
                                        <a class="mr-2 ml-4" href="#" onclick="event.preventDefault(); $('#upgrade-form{{$user->id}}').submit()">
                                            <img width="15px" height="15px" src="{{ asset('svg/briefcase.svg') }}">
                                        </a>
                                    </div>
                                    <form id="delete-form{{$user->id}}" action="/user/{{$user->id}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                    <form id="upgrade-form{{$user->id}}" action="/upgradeUser/{{$user->id}}" method="POST">
                                        @csrf
                                    </form>
                                </div>
                            </td>
                        @endcan
                        </tr>
                        @endif
                    @endforeach 
                    </table>
                    {{$users->links()}}