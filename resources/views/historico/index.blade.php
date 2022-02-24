@extends('layouts.app')
@section('content')

<div class="card-header">{{ __('Conversão de Moeda:') }}</div>

<div class="d-grid gap-2 d-md-flex justify-content-md-end m-t-30">
    <a href="{{ route('conversao.novo')}}" class="btn btn-primary me-md-2" type="button">Nova Conversão</a>
</div>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Moeda Origem</th>
            <th scope="col">Moeda Destino</th>
            <th scope="col">Valor Conversão</th>
            <th scope="col">Valor Comprado</th>
            <th style="text-align: center;" scope="col text-center">AÇÕES</th>
        </tr>
    </thead>
    <tbody>
        @foreach($dados as $dado)
        <tr>
            <th scope="row">{{ $dado->id }}</th>
            <td>{{ $dado->moeda_origem }}</td>
            <td>{{ $dado->moeda_destino }}</td>
            <td>{{ $dado->valor_conversao }}</td>
            <td>{{ $dado->valor_comprado . ' ' . $dado->moeda_destino }}</td>
            <td class="text-center">
                <a href="{{ route('conversao.show', $dado->id) }}">+Detalhes</a> |
                <a href="{{ route('conversao.mail', $dado->id ) }}">Receber E-mail</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex">
    {{ $dados->links() }}
</div>
@endsection
