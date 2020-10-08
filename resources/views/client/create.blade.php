@extends('layout')
@section('title', 'Create Client')
@section('content')
    <form action="{{route('store_client')}}" method="post" >
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input class="form-control" id="name" name="name">

            @error('name')
                <div class="alert alert-danger">{{$message}}</div>
            @enderror

            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email">

            @error('email')
                <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>
        <button class="btn btn-primary ">Store Client</button>
    </form>
@endsection
