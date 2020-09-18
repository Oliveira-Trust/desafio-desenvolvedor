@extends('layout')

@section('title')
    Central de Pedidos - Novo Cliente
@endsection

@section('header')
    Novo Cliente
@endsection

@section('content')
    <form action="{{route('storeClient')}}" method="post">
        @csrf

        <div class="row">
            <div class="form-group col-md">
                <label for="name">Nome</label>
                <input type="text" class="form-control" name="name" id="name">
            </div>

            <div class="form-group col-md">
                <label for="email">E-mail</label>
                <input type="text" class="form-control" name="email" id="email">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md">
                <label for="birthday">Dt Nascimento</label>
                <input type="date" class="form-control" name="birthday" id="birthday">
            </div>

            <div class="form-group col-md">
                <label for="created">Dt Cadastro</label>
                <input type="text" class="form-control" id="created" value="{{ date('d/m/Y') }}" disabled>
            </div>
        </div>

        <div class="row">
            <button class="btn btn-dark col-md-2 offset-md-10">Adicionar</button>
        </div>
    </form>
@endsection
