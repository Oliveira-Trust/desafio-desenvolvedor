@extends('layouts.app')

@section('content')

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="container-fluid">
    <form class="row" method="POST" action="{{ route('conversao-taxa.update', $taxa_conversao->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group col-2">
            <label>Valor:</label>
            <input type="number" name="valor" class="@error('valor') is-invalid @enderror form-control" value="{{ $taxa_conversao->valor }}">
            @error('valor')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="form-group col-2">
            <label>Tipo:</label>
            <select class="@error('tipo') is-invalid @enderror form-control" name="tipo">
                <option value="menor" @if(isset($taxa_conversao) && $taxa_conversao->tipo == 'menor') selected @endif>Menor</option>
                <option value="maior" @if(isset($taxa_conversao) && $taxa_conversao->tipo == 'maior') selected @endif>Maior</option>
            </select>
            @error('tipo')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="form-group col-2">
            <label>Taxa:</label>
            <input type="number" name="taxa" class="@error('taxa') is-invalid @enderror form-control" value="{{ $taxa_conversao->taxa }}">
            @error('taxa')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group col-2 pt-4">
            <button type="submit" class="btn btn-primary btn-sm">Editar</button>
        </div>
    </form>
</div>
@endsection