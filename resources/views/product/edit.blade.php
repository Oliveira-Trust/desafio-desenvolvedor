@extends('layout')
@section('title', 'Edit Product')
@section('content')
    <form action="{{route('update_product', $product->id)}}" method="post">
        @csrf
        @method('patch')
        <div class="form-group">
            <label for="name">Name:</label>
            <input class="form-control" type="text" id="name" name="name" value="{{$product->name}}">

            @error('name')
                <div class="alert alert-danger">{{$message}}</div>
            @enderror

            <label for="price">Price:</label>
            <input class="form-control" type="text" id="price" name="price" value="{{$product->price}}">

            @error('price')
                <div class="alert alert-danger">{{$message}}</div>
            @enderror
            <button class="btn btn-light">Update Product</button>
        </div>
    </form>
@endsection
