@foreach($clients as $client)
    <p>Nome:{{$client->name}}</p>
    <p>Nome:{{$client->email}}</p>
    <form action="{{route('destroy_client', ['client' => $client->id])}}" method="post">
        @csrf
        @method('delete')
        <button>Deletar</button>
    </form>
    <hr>

@endforeach
