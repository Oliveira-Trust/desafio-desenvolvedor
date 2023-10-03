@php use App\Enums\PaymentType; @endphp

@extends('panel.template.panel')

@section('title-page')
    Conversão
@endsection

@php
    $currencyQuotation = session('currencyQuotation', null);
@endphp

@section('content')
    <div id="loader-container" style="display: none">
        <div id="loader"></div>
    </div>

    <div class="row">

        <div @class(['col-lg-6' => $currencyQuotation, 'col-lg-12' => empty($currencyQuotation) ])">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <h2 class="panel-title">Conversor de moedas</h2>
                </div>

                <div class="panel-body">
                    @include('shared.errors')

                    @include('shared.alerts')
                    <form action="{{ route('currencyExchange') }}" method="POST" id="currencyExchangeForm">
                        @csrf

                        <div class="form-group @error('source_currency') has-error @enderror">
                            <label for="source_currency" class="control-label">Moeda de origem</label>
                            <select id="source_currency" name="source_currency" class="form-control @error('source_currency') field-error @enderror" readonly>
                                <option value="BRL">Real Brasileiro (BRL)</option>
                            </select>
                            <x-errors-field field="source_currency" />
                        </div>
                        <div class="form-group @error('conversion_value') has-error @enderror">
                            <label for="valor" class="control-label">Valor</label>
                            <input type="text" id="conversion_value" name="conversion_value" class="form-control @error('conversion_value') field-error @enderror"
                                maxlength="12" value="{{ old('conversion_value') ?? request('conversion_value', '') }}" placeholder="Informe o valor para conversão...">
                            <x-errors-field field="conversion_value" />
                        </div>
                        <div class="form-group @error('destination_currency') has-error @enderror">
                            <label for="destination_currency" class="control-label">Moeda de destino</label>
                            <select id="destination_currency" name="destination_currency" class="form-control @error('destination_currency') field-error @enderror">
                                <option value="">Selecione a moeda de destino...</option>
                                @foreach($availableCurrencies as $currencyCode => $currencyName)
                                    <option value="{{ $currencyCode }}" @selected(in_array($currencyCode, [old('destination_currency'), request('destination_currency', '')]))>
                                        {{ $currencyName }} ({{ $currencyCode }})
                                    </option>
                                @endforeach
                            </select>
                            <x-errors-field field="destination_currency" />
                        </div>
                        <div class="form-group @error('payment_type') has-error @enderror">
                            <label for="payment_type" class="control-label m-r-10">Forma de Pagamento</label>
                            <div class="radio radio-success radio-inline">
                                <input type="radio" id="creditCardPaymentType" name="payment_type" value="CREDIT_CARD" class="form-control"
                                    @checked( in_array(PaymentType::CreditCard->value, [ old('payment_type'), request('payment_type', '') ]) ) />
                                <label for="creditCardPaymentType" class="control-label"> Cartão de Crédito </label>
                            </div>
                            <div class="radio radio-info radio-inline">
                                <input type="radio" id="boletoPaymentType" name="payment_type" value="BOLETO" class="form-control"
                                    @checked( in_array(PaymentType::Boleto->value, [ old('payment_type'), request('payment_type', '') ]) )/>
                                <label for="boletoPaymentType" class="control-label">Boleto</label>
                            </div>
                            <x-errors-field field="payment_type" />
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-success waves-effect waves-light btn-lg" id="currencyExchangeButton">Converter</button>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        </div>
                    </form>

                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col -->


        @if ($currencyQuotation)
        <div class="col-lg-6">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <h2 class="panel-title">Resultados da Cotação</h2>
                </div>

                <div class="panel-body">
                    <div class="form-group">
                        <label for="moeda_origem">Moeda de origem</label>
                        <span class="block">{{ getSourceCurrency($currencyQuotation) }}</span>
                    </div>
                    <div class="form-group">
                        <label for="moeda_origem">Moeda de destino</label>
                        <span class="block">{{ getDestinationCurrency($currencyQuotation) }}</span>
                    </div>
                    <div class="form-group">
                        <label for="valor">Valor para conversão</label>
                        <span class="block">{{ formatCurrencyValue($currencyQuotation?->conversion_value) }}</span>
                    </div>
                    <div class="form-group">
                        <label for="moeda_destino">Forma de Pagamento</label>
                        <span class="block">{{ PaymentType::getDescription($currencyQuotation?->payment_type) }}</span>
                    </div>
                    <div class="form-group">
                        <label for="moeda_destino">Valor de R$ 1,00 na moeda "{{  $currencyQuotation ? getDestinationCurrency($currencyQuotation) : 'Moeda de destino' }}" corresponde ao valor de</label>
                        <span class="block">{{ formatMoney($currencyQuotation?->bid, $currencyQuotation?->codein) }}</span>
                    </div>
                    <div class="form-group">
                        <label for="moeda_destino">Valor comprado convertido em "{{ $currencyQuotation ? getDestinationCurrency($currencyQuotation) : 'Moeda de destino' }}"</label>
                        <span class="block">
                            {{ formatMoney($currencyQuotation->destination_currency_liquid_conversion_value, $currencyQuotation->codein) }}
                            <span class="text-danger">{{ $currencyQuotation?->conversion_value ? '(taxas aplicadas no valor de compra diminuindo no valor total de conversão)' : '' }}</span>
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="moeda_destino">Taxa de pagamento</label>
                        <span class="block">{{ formatCurrencyValue($currencyQuotation?->payment_tax) }}</span>
                    </div>
                    <div class="form-group">
                        <label for="moeda_destino">Taxa de conversão</label>
                        <span class="block">{{ formatCurrencyValue($currencyQuotation?->conversion_tax) }}</span>
                    </div>
                    <div class="form-group">
                        <label for="moeda_destino">Valor utilizado para conversão descontando as taxas</label>
                        <span class="block">{{ formatCurrencyValue($currencyQuotation?->liquid_conversion_value) }}</span>
                    </div>
                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col -->
        @endif
    </div>
@endsection

@push('css')
    <style type="text/css">
        #loader-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        #loader {
            border: 8px solid #f3f3f3;
            border-top: 8px solid #5cb85c;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
@endpush

@section('js')
    <script src="{{ asset('assets/common/js/jquery.maskMoney.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#conversion_value').maskMoney({ prefix:'R$ ', decimal: ',', thousands: '.' });

            $('#currencyExchangeButton').click(function() {
                $("#loader-container").fadeIn();

                $(this).text('carregando...').prop('disabled', true);

                // Submit the form or perform other actions
                $('#currencyExchangeForm').submit();

                $('#source_currency,#conversion_value,#destination_currency,#creditCardPaymentType,#boletoPaymentType')
                    .prop('disabled', true);
            });
        });
    </script>
@endsection
