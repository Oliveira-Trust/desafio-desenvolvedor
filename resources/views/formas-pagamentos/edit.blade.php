@extends('layouts.app')
@section('content')

<div class="card-header">{{ __('Editar Forma de Pagamento:') }}</div>

<div class="col m-t-30">
    <form method="post" action="{{ route('formas.pag.update', $forma->id) }}">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label class="form-label">Nome:</label>
            <input type="text" class="form-control @error('nome') is-invalid @enderror" placeholder="" name="nome" value="{{ old('nome', $forma->nome) }}">

            @error('nome')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Taxa:</label>
            <input type="text" class="form-control @error('taxa') is-invalid @enderror" placeholder="Ex: 1.5" name="taxa" value="{{ old('taxa', $forma->taxa) }}">

            @error('taxa')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a type="button" href="{{ route('formas.pags') }}" class="btn btn-secondary">Voltar para Listagem</a>
            <button type="submit" class="btn btn-primary">Atualizar</button>
        </div>

    </form>
</div>

<script>
    $('.money').mask("#,##0.00", {
        reverse: true
    });
</script>
@endsection
