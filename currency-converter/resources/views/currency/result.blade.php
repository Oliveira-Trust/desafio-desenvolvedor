@extends('layouts.app')

@section('title', 'Resultado da Conversão')

@section('content')
    <h1>Resultado da Conversão</h1>
    <p><strong>Valor para Conversão:</strong> R$ {{ number_format($amount, 2, ',', '.') }}</p>
    <p><strong>Moeda de Destino:</strong> {{ $currency }}</p>
    <p><strong>Forma de Pagamento:</strong> {{ $payment_method == 'boleto' ? 'Boleto' : 'Cartão de Crédito' }}</p>
    <p><strong>Taxa de Câmbio:</strong> R$ {{ number_format($exchange_rate, 2, ',', '.') }}</p>
    <p><strong>Valor Convertido:</strong> $ {{ number_format($converted_amount, 2, ',', '.') }}</p>
    <p><strong>Taxa de Pagamento:</strong> R$ {{ number_format($payment_fee, 2, ',', '.') }}</p>
    <p><strong>Taxa de Conversão:</strong> R$ {{ number_format($conversion_fee, 2, ',', '.') }}</p>
    <p><strong>Valor Final (BRL):</strong> R$ {{ number_format($final_amount, 2, ',', '.') }}</p>

    <!-- Botão Voltar -->
    <a href="{{ route('currency.index') }}" class="btn btn-secondary">Voltar</a>
@endsection
