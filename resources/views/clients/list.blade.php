@extends('layout')

@section('title')
    Central de Pedidos - Lista de Clientes
@endsection

@section('header')
    Lista de Clientes
@endsection

@section('content')
    @include('message', ['message' => $message])

    <a href="{{route('formCreateClient')}}" class="btn btn-dark mb-2">Novo Cliente</a>

    <div class="table-responsive">
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Dt Nascimento</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $client)
                    <tr>
                        <th scope="row">{{$loop->index + 1}}</th>
                        <td>{{$client->name}}</td>
                        <td>{{$client->email}}</td>
                        <td>{{$client->birthday->format('d/m/Y')}}</td>
                        <td>{{$client->created_at->format('d/m/Y')}}</td>
                        <td>
                            <span class="d-flex">
                                <a href="{{route('formEditClient', $client->id)}}" class="btn btn-info btn-sm mr-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="post" action="{{ route('destroyClient', $client->id) }}"
                                    onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($client->name) }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </form>
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
