@extends('table')
@section('title', 'Show Product')
@section('headers')
    <th>Name</th>
    <th>Price</th>
@endsection
@section('body')
    <tr>
        <td>{{$product->name}}</td>
        <td>{{$product->price}}</td>
        <td><a class="btn btn-success" href="{{route('edit_product', $product->id)}}">Edit Product</a></td>
        <td>
            <form action="{{route('destroy_product', $product->id)}}" method="post">
                @csrf
                @method('DELETE')
                <button class="position-relative btn btn-danger">Delete Product</button>
            </form>
        </td>
    </tr>
@endsection
