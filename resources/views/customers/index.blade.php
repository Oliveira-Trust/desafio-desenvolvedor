@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header h3">
            Consulta taxas e conversão
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sma-12 col-md-6">
                    <form id="exchange_puchase">
                        @csrf
                        @include('customers.forms.form-exchange-purchase')
                    </form>
                </div>
                <div class="col-sma-12 col-md-6 pl-5" id="info-exchange" style="display: none;">
                    <h4>Informações da compra</h4>
                    <p id="purchaseValue">Valor total da compra: <span></span></p>
                    <p id="currencyFrom">Moeda de origem: <span></span></p>
                    <p id="currencyTo">Moeda de destino: <span></span></p>
                    <p id="currencyToValue">Cotação da moeda de destino: <span></span></p>
                    <hr class="mt-3"/>
                    <h4>Compra no cartão</h4>
                    <p id="creditCardTax">Taxa do Carão de Crédito: <span></span></p>
                    <p id="creditCardTaxValue">Total de taxa do Cartão: <span></span></p>
                    <p id="creditCardPurchaseValue">Valor da compra em <b></b>: <span></span></p>
                    <hr class="mt-3"/>
                    <h4>Compra no Boleto</h4>
                    <p id="ticketTax">Taxa do Boleto: <span></span></p>
                    <p id="ticketTaxValue">Total de taxa do Boleto: <span></span></p>
                    <p id="tiketPurchaseValue">Valor da compra em <b></b>: <span></span></p>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    @include('customers.scripts.purchase')
@endsection
