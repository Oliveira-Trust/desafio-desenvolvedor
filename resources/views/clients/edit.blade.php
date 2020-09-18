@extends('layout')

@section('title')
    Central de Pedidos - Editar Cliente
@endsection

@section('header')
    Editar Cliente
@endsection

@section('content')
    <form action="{{route('updateClient', $client->id)}}" method="post">
        @csrf

        <div class="row">
            <div class="form-group col-md">
                <label for="name">Nome</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ $client->name }}">
            </div>

            <div class="form-group col-md">
                <label for="email">E-mail</label>
                <input type="text" class="form-control" name="email" id="email" value="{{ $client->email }}">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md">
                <label for="birthday">Dt Nascimento</label>
                <input type="date" class="form-control" name="birthday" id="birthday" value="{{ $client->birthday->format('Y-m-d') }}">
            </div>

            <div class="form-group col-md">
                <label for="created">Dt Cadastro</label>
                <input type="text" class="form-control" id="created" value="{{ $client->created_at->format('d/m/Y') }}" disabled>
            </div>
        </div>

        <div class="row">
            <button class="btn btn-dark col-md-2 offset-md-10">Adicionar</button>
        </div>
    </form>
@endsection
