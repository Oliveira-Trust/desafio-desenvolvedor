<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Conversão de moeda</title>

    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    <fieldset>
        <h2>Conversor de Real</h2>
        <div class="form">
            <form action="{{ route('currency.store') }}" method="POST" name="form">
                @csrf
                <div class="row">
                    <div class="form-group col-md-2">
                        <label for="value" class="title">Valor</label>
                        <input type="number" name="value" id="value" class="form-control form-control-md" value="{{(isset($viewData->valueToConvert) ? $viewData->valueToConvert : null)}}"
                        placeholder="Ex:1000" required min="1000" max="100000" step="0.01">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="first_currency" class="title">Escolha a moeda</label>
                        <select id="first_currency" name="first_currency" class="form-control form-control-md">
                            <option value="BRL" selected>Real</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="second_currency" class="title">Converter para</label>
                        <select id="second_currency" name="second_currency" class="form-control form-control-md" required>
                            <option value=""    {{ (!isset($viewData->destinyCurrency)) ? "selected" : ""}}></option>
                            <option value="USD" {{ (isset($viewData->destinyCurrency) && $viewData->destinyCurrency == 'USD') ? "selected" : ""}}>Dólar Americano</option>
                            <option value="EUR" {{ (isset($viewData->destinyCurrency) && $viewData->destinyCurrency == 'EUR') ? "selected" : ""}}>Euro</option>
                            <option value="THB" {{ (isset($viewData->destinyCurrency) && $viewData->destinyCurrency == 'THB') ? "selected" : ""}}>Baht</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="payment_method" class="title">Método de pagamento</label>
                        <select id="payment_method" name="payment_method" class="form-control form-control-md" required>
                            <option value="" {{ !isset($viewData->paymentMethod) ? "selected" : ""}}></option>
                            <option value="billet" {{ (isset($viewData->paymentMethod) && $viewData->paymentMethod == 'billet') ? "selected" : ""}}>Boleto</option>
                            <option value="credit_card" {{ (isset($viewData->paymentMethod) && $viewData->paymentMethod == 'credit_card') ? "selected" : ""}}>Cartão de crédito</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <div class="submit-button">
                            <button type="submit" class="btn btn-primary"><span class="title">Converter</span></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </fieldset>
    <hr>
    <fieldset>
        @if(isset($viewData->destinyCurrencyBought))
            <h2>Resultado</h2>
            <div class="result">
                <div class="row">
                    <div class="form-group col-md-6 result-value">
                        <span class="title">Moeda de origem:</span>
                        <span class="data">{{ $viewData->originCurrencyDescription }}</span>
                    </div>
                    <div class="form-group col-md-6 result-value">
                        <span class="title">Moeda de destino:</span>
                        <span class="data">{{ $viewData->destinyCurrencyDescription }}</span>
                    </div>
                    <div class="form-group col-md-6 result-value">
                        <span class="title">Valor para conversão:</span>
                        <span class="data">{{ number_format($viewData->valueToConvert,2,",",".") }}</span>
                    </div>
                    <div class="form-group col-md-6 result-value">
                        <span class="title">Forma de pagamento:</span>
                        <span class="data">{{ translatePaymentMethod($viewData->paymentMethod) }}</span>
                    </div>
                    <div class="form-group col-md-6 result-value">
                        <span class="title">Valor moeda destino ({{ $viewData->destinyCurrency }}):</span>
                        <span class="data">{{ number_format($viewData->valueDestinyCurrencyConverted,2,",",".") }}</span>
                    </div>
                    <div class="form-group col-md-6 result-value">
                        <span class="title">Valor comprado em {{ $viewData->destinyCurrency }}:</span>
                        <span class="data">{{ number_format($viewData->destinyCurrencyBought,2,",",".") }}</span>
                    </div>
                    <div class="form-group col-md-6 result-value">
                        <span class="title">Taxa de pagamento:</span>
                        <span class="data">R$ {{ number_format($viewData->paymentFee,2,",",".") }}</span>
                    </div>
                    <div class="form-group col-md-6 result-value">
                        <span class="title">Taxa de conversão:</span>
                        <span class="data">R$ {{ number_format($viewData->conversionFee,2,",",".") }}</span>
                    </div>
                    <div class="form-group col-md-6 result-value">
                        <span class="title">Valor utilizado para conversão descontando as taxas:</span>
                        <span class="data">R$ {{ number_format($viewData->valueUsedForConversionMinusFees,2,",",".") }}</span>
                    </div>
                </div>
            </div>
        @endif
    </fieldset>
</body>
</html>