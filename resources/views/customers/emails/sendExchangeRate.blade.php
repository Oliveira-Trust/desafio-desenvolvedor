@extends('layouts.email')

@section('content')

<div style="padding: 50px;">
    <h3>Nome do cliente: {{$user->name}}</h3>
    <h4 class="label">Informações da compra</h4>
    <p id="purchaseValue">Valor total da compra: <span>{{$exchange->exchange->amount}}</span></p>
    <p id="currencyFrom">Moeda de origem: <span>{{$exchange->exchange->from}}</span></p>
    <p id="currencyTo">Moeda de destino: <span>{{$exchange->exchange->to}}</span></p>
    <p id="currencyToValue">Cotação da moeda de destino:
        <span>{{$exchange->exchange->to_value}}</span></p>


    <h4 class="label">Compra no cartão</h4>
    <p id="creditCardTax">Taxa do Carão de Crédito:
        <span>{{$exchange->exchange->creditCard->tax}}</span></p>
    <p id="creditCardTaxValue">Total de taxa do Cartão:
        <span>{{$exchange->exchange->creditCard->amount}}</span></p>
    <p id="creditCardPurchaseValue">Valor da compra em <b>{{$exchange->exchange->to}}</b>:
        <span>{{$exchange->exchange->creditCard->puchase_amount_to}}</span></p>

    <h4 class="mt-3 label">Compra no Boleto</h4>
    <p id="ticketTax">Taxa do Boleto: <span>{{$exchange->exchange->ticket->tax}}</span></p>
    <p id="ticketTaxValue">Total de taxa do Boleto:
        <span>{{$exchange->exchange->ticket->amount}}</span></p>
    <p id="tiketPurchaseValue">Valor da compra em <b>{{$exchange->exchange->to}}</b>:
        <span>{{$exchange->exchange->ticket->puchase_amount_to}}</span></p>
</div>

@endsection
