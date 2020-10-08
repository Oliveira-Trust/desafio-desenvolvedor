@extends('table')
@section('title', 'Show Client')
@section('headers')
    <th>Name</th>
    <th>Email</th>
@endsection
@section('body')
    <tr>
        <td>{{$client->name}}</td>
        <td>{{$client->email}}</td>
        <td><a class="btn btn-success" href="{{route('edit_client', $client->id)}}">Edit Client</a></td>
        <td>
            <form action="{{route('destroy_client', $client->id)}}" method="post">
                @csrf
                @method('DELETE')
                <button class="position-relative btn btn-danger">Delete Client</button>
            </form>
        </td>
    </tr>
@endsection
