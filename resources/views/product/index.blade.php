@foreach($products as $product)
    <p>Nome:{{$product->name}}</p>
    <p>Price:{{$product->price}}</p>
    <form action="{{route('destroy_product', ['product' => $product->id])}}" method="post">
        @csrf
        @method('delete')
        <button>Deletar</button>
    </form>
    <hr>

@endforeach
