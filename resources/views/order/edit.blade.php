<form action="{{route('update_order', ['order' => $order->id])}}" method="post">
    @csrf
    @method('patch')
    <label for="client_id">Client: </label>
    <select name="client_id" id="client_id">
        @foreach($clients as $client)
            <option value="{{$client->id}}">{{$client->name}}</option>
        @endforeach
    </select>
    <label for="product_id"></label>
    <select name="product_id" id="product_id">
        @foreach($products as $product)
            <option value="{{$product->id}}">{{$product->name}}</option>
        @endforeach
    </select>
    <label for="status"></label>
    <select name="status" id="status">
        <option value="Pago">Pago</option>
        <option value="Cancelado">Cancelado</option>
        <option value="Em Andamento">Em Andamento</option>
    </select>
    <button>Update</button>
</form>
