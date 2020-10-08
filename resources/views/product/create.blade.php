@extends('layout')
@section('title', 'Create Product')
@section('content')
    <form action="{{route('store_product')}}" method="post" >
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input class="form-control" id="name" name="name">

            @error('name')
                <div class="alert alert-danger">{{$message}}</div>
            @enderror

            <label for="price">Price:</label>
            <input type="text" class="form-control" id="price" name="price">

            @error('price')
                <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>
        <button class="btn btn-primary ">Store Product</button>
    </form>
@endsection
