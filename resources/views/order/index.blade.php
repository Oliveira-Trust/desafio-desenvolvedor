@foreach($orders as $order)
    <p>Client: {{$order->client->name}}</p>
    <p>Product: {{$order->product->name}}</p>
    <p>Status: {{$order->status}}</p>
    <form action="{{route('destroy_order', ['order' => $order->id])}}" method="post">
        @csrf
        @method('delete')
        <button>Delete</button>
    </form>
    <hr>
@endforeach
