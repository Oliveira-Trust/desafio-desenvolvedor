<!DOCTYPE html>
<html>
<head>
    <title>Resultado da Conversão</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
    <div class="container mt-5">
    <div class="mx-auto p-2" style="width: 500px;">
    <div class="shadow-none p-3 mb-5  rounded w-100 p-3">
    <img src="{!! asset('img/coin.svg') !!}" class="mb-4" height="57" width="72" />
        <h1 class="mb-4">Resultado da Conversão</h1>
        <ul class="list-group">
            <li class="list-group-item"><strong>Moeda de Origem:</strong> BRL</li>
            <li class="list-group-item"><strong>Moeda de Destino:</strong> {{ $moedaDestino }}</li>
            <li class="list-group-item"><strong>Valor para Conversão:</strong> R$ {{ number_format($valor, 2, ',', '.') }}</li>
            <li class="list-group-item"><strong>Forma de Pagamento:</strong> {{ ucfirst($formaPagamento) }}</li>
            <li class="list-group-item"><strong>Valor da Cotação:</strong> {{ $cotacao }}</li>
            <li class="list-group-item"><strong>Taxa de Pagamento:</strong> R$ {{ number_format($valor * ($taxaPagamento / 100), 2, ',', '.') }}</li>
            <li class="list-group-item"><strong>Taxa de Conversão:</strong> R$ {{ number_format($valorComTaxaPagamento * ($taxaConversao / 100), 2, ',', '.') }}</li>
            <li class="list-group-item"><strong>Valor Utilizado para Conversão:</strong> R$ {{ number_format($valorComTaxaConversao, 2, ',', '.') }}</li>
            <li class="list-group-item"><strong>Valor Convertido:</strong> {{ $moedaDestino }} {{ number_format($valorConvertido, 2, ',', '.') }}</li>
        </ul>
        <a href="{{ route('home') }}" class="btn btn-primary mt-3">Nova Conversão</a>
    </div>
    </div>
    </div>
</body>

<div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

</html>
