@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h2 class="mb-4">Cadastro de Clientes</h2>
    
    <form action="{{ route('clients.store') }}" method="POST" autocomplete="off">

        @csrf

        <div class="form-group form-row">
            <label for="name">Nome:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="form-group form-row">
            <div class="col-lg-4">
                <label for="datebirth">Data de Nascimento:</label>
                <input type="date" class="form-control" id="datebirth" name="datebirth" required>
            </div>
            
            <div class="col-lg-4">
                <label for="cpf">CPF:</label>
                <input type="text" class="form-control maskCpf" id="cpf" name="cpf" required>
            </div>
            
            <div class="col-lg-4">
                <label for="telephone">Telefone:</label>
                <input type="text" class="form-control maskTel" id="telephone" name="telephone" required>
            </div>
        </div>

        <button type="submit" class="btn btn-info text-white">Cadastrar Cliente</button>
        <a href="{{ route('clients.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>
@endsection