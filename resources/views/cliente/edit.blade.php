@extends('layouts.app')

@section('title', 'Editar Cliente')

@section('content')
    <div class="row mt-1">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="{{ route('clientes.index') }}">Clientes</a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar Cliente</li>
            </ol>
        </nav>
    </div>
    <div class="row mt-4">
        <div class="col-md-8 mb-1">
            <h4>Editar Cliente</h4>
            <hr>
        </div>
        <div class="col-md-8">
            <div class="card text-dark">
                <div class="card-body">

                    <form method="POST" action="{{ route('clientes.update', $cliente->id) }}" class="row">
                        @csrf
                        @method('PUT')
                        <div class="col-md-6 mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome"
                                name="nome" placeholder="Nome ou rasão social" value="{{ $cliente->nome }}">
                            @error('nome')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="cpf_cnpj" class="form-label">CPF/CNPJ</label>
                            <input type="number" class="form-control @error('cpf_cnpj') is-invalid @enderror" id="cpf_cnpj"
                                name="cpf_cnpj" placeholder="Somente números" value="{{ $cliente->cpf_cnpj }}">
                            @error('cpf_cnpj')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-9 mb-3">
                            <label for="endereco" class="form-label">Endereço</label>
                            <input type="text" class="form-control @error('endereco') is-invalid @enderror" id="endereco"
                                name="endereco" placeholder="Seu endereço com o número" value="{{ $cliente->endereco }}">
                            @error('endereco')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="numero" class="form-label">Numero</label>
                            <input type="text" class="form-control @error('numero') is-invalid @enderror" id="numero"
                                name="numero" placeholder="Número" value="{{ $cliente->numero }}">
                            @error('numero')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="cep" class="form-label">Cep</label>
                            <input type="text" class="form-control @error('cep') is-invalid @enderror" id="cep" name="cep"
                                placeholder="qual o cep?" value="{{ $cliente->cep }}">
                            @error('cep')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="bairro" class="form-label">Bairro</label>
                            <input type="text" class="form-control @error('bairro') is-invalid @enderror" id="bairro"
                                name="bairro" placeholder="qual o bairro?" value="{{ $cliente->bairro }}">
                            @error('endereco')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="cidade" class="form-label">Cidade</label>
                            <input type="text" class="form-control @error('cidade') is-invalid @enderror" id="cidade"
                                name="cidade" placeholder="Qual a cidade?" value="{{ $cliente->cidade }}">
                            @error('cidade')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="uf" class="form-label">UF</label>
                            <input type="text" class="form-control @error('uf') is-invalid @enderror" id="uf" name="uf"
                                placeholder="digite o estado" value="{{ $cliente->uf }}">
                            @error('uf')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-success mt-2">Salvar</button>
                            <a href="javascript:history.back()" class="btn btn-danger mt-2">Cancelar</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
