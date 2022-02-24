@extends('layouts.app')
@section('content')

<div class="card-header">{{ __('Editar de Moeda:') }}</div>

<div class="col m-t-30">
    <form method="post" action="{{ route('moeda.update', $moeda->id) }}">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label class="form-label">Nome da Moeda:</label>
            <input type="text" class="form-control @error('nome') is-invalid @enderror" placeholder="" name="nome" value="{{ old('nome', $moeda->nome) }}">

            @error('nome')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Sigla da Moeda:</label>
            <input style="text-transform:uppercase" type="text" class="form-control @error('sigla') is-invalid @enderror" placeholder="" name="sigla" value="{{ old('sigla', $moeda->sigla) }}">

            @error('sigla')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a type="button" href="{{ route('moedas') }}" class="btn btn-secondary">Voltar Moedas</a>
            <button type="submit" class="btn btn-primary">Atualizar</button>
        </div>
    </form>
</div>
@endsection
