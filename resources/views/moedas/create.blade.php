@extends('layouts.app')
@section('content')

<div class="card-header">{{ __('Cadastro de Moeda:') }}</div>

<div class="col m-t-30">
    <form method="POST" action="{{ route('moeda.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nome da Moeda:</label>
            <input type="text" class="form-control @error('nome') is-invalid @enderror" placeholder="" name="nome" value="{{ old('nome') }}">

            @error('nome')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Sigla da Moeda:</label>
            <input style="text-transform:uppercase" type="text" class="form-control @error('sigla') is-invalid @enderror" placeholder="" name="sigla" value="{{ old('sigla') }}">

            @error('sigla')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a type="button" href="{{ route('moedas') }}" class="btn btn-secondary">Voltar Moedas</a>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </div>
    </form>
</div>
@endsection
