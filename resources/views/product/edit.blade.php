<form action="{{route('update_product',['product' => $product->id])}}" method="post">
    @csrf
    @method('patch')
    <label for="name">Nome:</label>
    <input type="text" value="{{$product->name}}" name="name" id="name">
    <label for="price">Price:</label>
    <input type="text" value="{{$product->price}}" name="price" id="price">
    <button>Editar</button>
</form>
