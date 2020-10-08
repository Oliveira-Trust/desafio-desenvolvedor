@extends('layout')
@section('title', 'Edit Client')
@section('content')
    <form action="{{route('update_client', $client->id)}}" method="post">
        @csrf
        @method('patch')
        <div class="form-group">
            <label for="name">Name:</label>
            <input class="form-control" type="text" id="name" name="name" value="{{$client->name}}">

            @error('name')
                <div class="alert alert-danger">{{$message}}</div>
            @enderror

            <label for="email">Email:</label>
            <input class="form-control" type="text" id="email" name="email" value="{{$client->email}}">

            @error('email')
                <div class="alert alert-danger">{{$message}}</div>
            @enderror
            <button class="btn btn-light">Update Client</button>
        </div>
    </form>
@endsection
