@extends('layout')

@section('title', 'Edit Order')

@section('content')
    <form action="{{route('update_order', $order->id)}}" method="post">
        @csrf
        @method('patch')
        <label for="client">Clients:</label>
        <select name="client_id" id="client" class="form-control">
            @forelse($clients as $client)
                <option value="{{$client->id}}">
                    {{$client->name}}
                </option>
            @empty
                <option value="">There are no clients</option>
            @endforelse
        </select>

        @error('client_id')
            <div class="alert alert-danger">{{$message}}</div>
        @enderror

        <label for="product">Products:</label>
        <select name="product_id" id="product" class="form-control">
            @forelse($products as $product)
                <option value="{{$product->id}}">
                    {{$product->name}}
                </option>
            @empty
                <option value="">There are no products</option>
            @endforelse
        </select>

        @error('product_id')
            <div class="alert alert-danger">{{$message}}</div>
        @enderror

        <label for="status">Status:</label>
        <select name="status" id="status" class="form-control">
            <option value="Paid">Paid</option>
            <option value="Canceled">Canceled</option>
            <option value="In Progress">In Progress</option>
        </select>
        <button class="btn btn-success">Update</button>

        @error('status')
            <div class="alert alert-danger">{{$message}}</div>
        @enderror
    </form>
@endsection
