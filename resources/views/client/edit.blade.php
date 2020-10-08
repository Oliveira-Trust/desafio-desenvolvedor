<form action="{{route('update_client',['client' => $client->id])}}" method="post">
    @csrf
    @method('patch')
    <label for="name">Nome:</label>
    <input type="text" value="{{$client->name}}" name="name" id="name">
    <label for="email">Email:</label>
    <input type="text" value="{{$client->email}}" name="email" id="email">
    <button>Editar</button>
</form>
