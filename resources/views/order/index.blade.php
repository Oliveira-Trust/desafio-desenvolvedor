@extends('table')

@section('title', 'Orders')

@section('headers')
    <th>Client</th>
    <th>Product</th>
    <th>Status</th>
@endsection

@section('body')
    @forelse($orders as $order)
        <tr>
            <td><a href="{{route('show_client', $order->client->id)}}">{{$order->client->name}}</a></td>

            <td><a href="{{route('show_product', $order->product->id)}}">{{$order->product->name}}</a></td>

            <td><a href="{{route('show_order', $order->id)}}">{{$order->status}}</a></td>

            <td><a class="btn btn-success" href="{{route('edit_order', $order->id)}}">Edit Order</a></td>
            <td>
                <form action="{{route('destroy_order', $order->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Delete Order</button>
                </form>
            </td>
            @empty
                <td>There are no orders</td>
            @endforelse
        </tr>
@endsection

@section('addBtn')
    <a class="btn btn-dark" href="{{route('create_order')}}" >Create Order</a>
@endsection
