@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Clientes</div>

                    <div class="col-12" style="margin-left: 15px; margin-top: 15px">
                        <p><a href="{{ route('clients.create') }}">Adicione um novo cliente</a></p>
                    </div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>#</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($clients as $client)
                                    <tr>
                                        <td><a href="{{ route('clients.show', ['client' => $client]) }}">{{ $client->name }}</a></td>

                                        <td>{{ $client->email }}</td>
                                        <td>
                                            <div class="row">
                                                <button class="btn btn-info"><a href="{{ route('clients.edit', ['client' => $client]) }}">editar</a></button>
                                                <form action="{{ route('clients.destroy', ['client' => $client]) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="btn btn-danger" type="submit">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


