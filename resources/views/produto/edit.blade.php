@extends('layouts.app')

@section('title', 'Editar Produto')

@section('content')
<div class="row mt-1">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('produtos.index') }}">Produtos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar Produto</li>
        </ol>
    </nav>
</div>
<div class="row mt-4">
    <div class="col-md-8 mb-1">
        <h4>Editar Produto</h4>
        <hr>
    </div>
    <div class="col-md-8">
        <div class="card text-dark">
            <div class="card-body">

                <form method="POST" action="{{ route('produtos.update', $produto->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição do Produto</label>
                        <input type="text" class="form-control @error('descricao') is-invalid @enderror" id="descricao"
                            name="descricao" aria-describedby="descricao" value="{{ $produto->descricao }}" required
                            autofocus>
                        @error('descricao')
                            <div id="descricaoHelp" class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="estoque" class="form-label">Estoque</label>
                        <input type="number" class="form-control @error('estoque') is-invalid @enderror" id="estoque"
                            name="estoque" value="{{ $produto->estoque }}" required>
                        @error('estoque')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="preco" class="form-label">Preço</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">R$</span>
                            <input type="text" class="form-control @error('preco') is-invalid @enderror" name="preco"
                                placeholder="Ex. 1500,00" aria-label="preco" aria-describedby="basic-addon1"
                                value="{{ number_format($produto->preco, 2, ',', '.') }}" required>
                        </div>
                        @error('preco')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success mt-2">Salvar</button>
                    <a href="javascript:history.back()" class="btn btn-danger mt-2">Cancelar</a>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
