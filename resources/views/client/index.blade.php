@extends('table')

@section('title', 'Clients')

@section('headers')
    <th>Name</th>
@endsection

@section('body')
    @forelse($clients as $client)
        <tr>
            <td><a href="{{route('show_client', $client->id)}}">{{$client->name}}</a></td>
            <td><a href="{{route('edit_client', $client->id)}}" class="btn btn-success">Edit Client</a></td>
            <td>
                <form action="{{route('destroy_client', $client->id)}}" method="post">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger">Delete Client</button>
                </form>
            </td>
            @empty
                <td>There are no clients</td>
            @endforelse
        </tr>
@endsection

@section('addBtn')
    <a class="btn btn-dark" href="{{route('create_client')}}">Create Client</a>
@endsection
