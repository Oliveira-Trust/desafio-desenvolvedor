@extends('table')

@section('title', 'Products')

@section('headers')
    <th>Name</th>
@endsection

@section('body')
    @forelse($products as $product)
        <tr>
            <td><a href="{{route('show_product', $product->id)}}">{{$product->name}}</a></td>
            <td><a href="{{route('edit_product', $product->id)}}" class="btn btn-success">Edit Product</a></td>
            <td>
                <form action="{{route('destroy_product', $product->id)}}" method="post">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger">Delete Product</button>
                </form>
            </td>
            @empty
                <td>There are no products</td>
            @endforelse
        </tr>
@endsection

@section('addBtn')
    <a class="btn btn-dark" href="{{route('create_product')}}">Create Product</a>
@endsection
