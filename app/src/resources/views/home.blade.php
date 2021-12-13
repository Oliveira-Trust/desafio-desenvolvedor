@extends('master', ['pageHeaderTitle' => 'Dashboard'])

@section('stylesheets')
    <link rel="stylesheet" href="{{ mix('css/pages/home.css') }}">
@endsection

@section('content')
    <div class="currency-converter">
        <form method="post" class="currency-converter-form">
            <h3 class="currency-converter-title">Conversor de Moedas</h3>

            <div>
                <div class="currency-converter-form-origin">
                    <div>
                        <label class="currency-converter-form-origin-label">Moeda Origem</label>
                        <select class="currency-converter-form-origin-currency">
                            <option value="BRL">Real Brasileiro</option>
                        </select>
                    </div>
                    <input class="currency-converter-form-origin-input" name="originValue" placeholder="Informe o valor">
                </div>

                <div class="currency-converter-form-destination">
                    <div>
                        <label class="currency-converter-form-destination-label">Moeda Destino</label>
                        <select class="currency-converter-form-destination-currency" name="destinationCurrency">
                            <option value="USD">Dólar Americano</option>
                            <option value="CAD">Dólar Canadense</option>
                            <option value="EUR">Euro</option>
                            <option value="JPY">Iene Japonês</option>
                            <option value="TRY">Lira Turca</option>
                        </select>
                    </div>
                    <input class="currency-converter-form-destination-input" readonly>
                </div>

                <div class="currency-converter-form-payment-method-box">
                    <label class="currency-converter-form-payment-method-label">Forma de pagamento</label>
                    <select class="currency-converter-form-payment-method" name="paymentMethod">
                        <option value="bankSlip">Boleto bancário - Taxa de 1,45%</option>
                        <option value="creditCard">Cartão - Taxa de 7,63%</option>
                    </select>
                </div>

                <button type="submit" class="currency-converter-form-submit btn-component">Converter</button>
            </div>
        </form>

        <div class="currency-converter-result">
            <h4>Resultado</h4>

            <ul class="currency-converter-result-list">
                <li class="currency-converter-result-list-item"><strong>Moeda de Origem</strong>: <span class="currency-converter-result-list-item-origin-currency"></span></li>
                <li class="currency-converter-result-list-item"><strong>Moeda de Destino</strong>: <span class="currency-converter-result-list-item-destination-currency"></span></li>
                <li class="currency-converter-result-list-item"><strong>Valor para conversão</strong>: <span class="currency-converter-result-list-item-origin-currency-value"></span></li>
                <li class="currency-converter-result-list-item"><strong>Forma de pagamento</strong>: <span class="currency-converter-result-list-item-payment-method"></span></li>
                <li class="currency-converter-result-list-item"><strong>Valor de <span></span> usado para conversão</strong>: <span class="currency-converter-result-list-item-destination-currency-base-value"></span></li>
                <li class="currency-converter-result-list-item"><strong>Valor comprado em <span></span></strong>: <span class="currency-converter-result-list-item-converted-value"></span></li>
                <li class="currency-converter-result-list-item"><strong>Taxa de pagamento</strong>: <span class="currency-converter-result-list-item-payment-tax"></span></li>
                <li class="currency-converter-result-list-item"><strong>Taxa de conversão</strong>: <span class="currency-converter-result-list-item-conversion-tax"></span></li>
                <li class="currency-converter-result-list-item"><strong>Valor utilizado para conversão descontando as taxas</strong>: <span class="currency-converter-result-list-item-origin-currency-net-value"></span></li>
            </ul>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ mix('js/pages/home.js') }}"></script>
@endsection
