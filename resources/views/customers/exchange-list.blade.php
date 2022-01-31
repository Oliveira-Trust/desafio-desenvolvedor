@extends('layouts.app')

@section('content')
    <div class="card m-3">
        <div class="h3 p-3">
            Cotações realizadas
        </div>
    </div>
    @foreach($exchanges as $exchange)
        <div class="card m-3">
            <div class="row mb-4 justify-content-center mt-3">
                <h4 class="label">Consultado em: {{$exchange->created_at->format('d/m/Y H:i:s')}}</h4>
            </div>
            <div class="row justify-content-center pl-5 pr-5 pb-4">
                <div class="col-sma-12 col-md-4">

                    <h4 class="label">Informações da compra</h4>
                    <p id="purchaseValue">Valor total da compra: <span>{{$exchange->exchange->amount}}</span></p>
                    <p id="currencyFrom">Moeda de origem: <span>{{$exchange->exchange->from}}</span></p>
                    <p id="currencyTo">Moeda de destino: <span>{{$exchange->exchange->to}}</span></p>
                    <p id="currencyToValue">Cotação da moeda de destino:
                        <span>{{$exchange->exchange->to_value}}</span></p>

                </div>
                <div class="col-sma-12 col-md-4">
                    <h4 class="label">Compra no cartão</h4>
                    <p id="creditCardTax">Taxa do Carão de Crédito:
                        <span>{{$exchange->exchange->creditCard->tax}}</span></p>
                    <p id="creditCardTaxValue">Total de taxa do Cartão:
                        <span>{{$exchange->exchange->creditCard->amount}}</span></p>
                    <p id="creditCardPurchaseValue">Valor da compra em <b>{{$exchange->exchange->to}}</b>:
                        <span>{{$exchange->exchange->creditCard->puchase_amount_to}}</span></p>

                </div>
                <div class="col-sma-12 col-md-4">
                    <h4 class="label">Compra no Boleto</h4>
                    <p id="ticketTax">Taxa do Boleto: <span>{{$exchange->exchange->ticket->tax}}</span></p>
                    <p id="ticketTaxValue">Total de taxa do Boleto:
                        <span>{{$exchange->exchange->ticket->amount}}</span></p>
                    <p id="tiketPurchaseValue">Valor da compra em <b>{{$exchange->exchange->to}}</b>:
                        <span>{{$exchange->exchange->ticket->puchase_amount_to}}</span></p>
                </div>
            </div>

        </div>
        @endforeach
        </div>
        <div class="container">
            <div class="row justify-content-center">
                {{$exchanges->render()}}
            </div>
        </div>
@endsection

