@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <form method="POST" action="{{ route('generateQuote') }}" id="form">
                    @csrf
                    <div class="card-header text-center">Conversor de Moedas</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <label>Converter de:</label>
                                <select id="origin-currency"
                                        data-show-content="true"
                                        class="form-control bg-primary text-white">
                                    <option>Real Brasileiro (BRL)</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label>Insira o valor (R$):</label>
                                <input id="money" type="text" name="money" class="form-control"
                                       placeholder="R$10,00" maxlength="10" autofocus>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <label>Para:</label>
                                <select name="destination-currency"
                                        id="destination-currency"
                                        data-show-content="true"
                                        class="form-control bg-primary text-white">
                                    <option value="null">Selecione</option>
                                    @foreach ($data as $d)
                                        <option
                                            value="{{ $d['prefix'] }}"
                                        >
                                            {{ $d['label'] }} ({{ str_replace('BRL-', '', $d['prefix']) }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 text-left text-justify d-flex justify-content-between align-items-baseline" id="payment">
                                <label>Forma de Pagamento: </label>
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-primary text-center">
                                        <input type="radio" name="credit-card"
                                               id="credit-card" autocomplete="off">Cartão de Crédito
                                    </label>
                                    <label class="btn btn-primary text-center">
                                        <input type="radio" name="bank-invoice"
                                               id="bank-invoice" autocomplete="off">Boleto
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4 justify-content-center">
                            <button class="btn btn-primary btn-block mr-2 ml-2" id="sendQuote">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                         class="bi bi-check-lg" viewBox="0 0 16 16">
                                        <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                                    </svg>
                                    <span>Gerar Cotação</span>
                            </button>
                            <button class="btn btn-primary btn-block mr-2 ml-2 d-none" id="buttonLoading" disabled>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Loading...
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-6 d-none" id="description-quote">
            <div class="card">
                <div class="card-header">Descrição da cotação</div>
                <div class="card-body">
                    <div class="row ml-1">
                        <label>Moeda de Origem: Real Brasileiro (BRL)</label>
                    </div>
                    <div class="row ml-1" id="description-currency-label">
                    </div>
                    <div class="row ml-1" id="description-value">
                    </div>
                    <div class="row ml-1" id="description-payment-label">
                    </div>
                    <div class="row ml-1" id="description-currency-price">
                    </div>
                    <div class="row ml-1" id="description-currency-value">
                    </div>
                    <div class="row ml-1" id="description-payment-fee">
                    </div>
                    <div class="row ml-1" id="description-conversion-fee">
                    </div>
                    <div class="row ml-1" id="description-final-value">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var buttonSendQuote = $('#sendQuote');
        var inputMoney = $('#money');
        var inputDestinationCurrency = $('#destination-currency');
        var inputCreditCard = $('#credit-card');
        var inputBankInvoice = $('#bank-invoice');
        var descriptionCurrency = $('#description-currency-label');
        var descriptionValue = $('#description-value');
        var descriptionPaymentLabel = $('#description-payment-label');
        var descriptionCurrencyPrice = $('#description-currency-price');
        var descriptionCurrencyValue = $('#description-currency-value');
        var descriptionPaymentFee = $('#description-payment-fee');
        var descriptionConversionFee = $('#description-conversion-fee')
        var descriptionFinalValue = $('#description-final-value');
        var buttonLoading = $('#buttonLoading');

        var payment = $('#payment');
        var payload = {};

        buttonSendQuote.on('click', function(event) {
            event.preventDefault();
            buttonSendQuote.hide();
            buttonLoading.removeClass('d-none');

            axios.post('{{ route('generateQuote') }}', payload)
                .then((response) => {
                    if (response.status === 200) {
                        setDescriptionQuote(response.data)
                    }
            })
            .catch(({response}) => {
                setErrosParametersInvalids(response)
            });
        });

        function setDescriptionQuote(data) {
            descriptionCurrency.children().remove();
            descriptionCurrency.append(`<label>Moeda de Destino: ` + data?.currency + `</label>`);
            descriptionValue.children().remove();
            descriptionValue.append(`<label>Valor para Conversão: `+ data?.value +`</label>`);
            descriptionPaymentLabel.children().remove();
            descriptionPaymentLabel.append(`<label>Forma de pagamento: `+ translatePayment(data?.methodPayment) +`</label>`);
            descriptionCurrencyPrice.children().remove();
            descriptionCurrencyPrice.append(`<label>Valor da Moeda de Destino: `+ data?.priceCurrency +`</label>`);
            descriptionCurrencyValue.children().remove();
            descriptionCurrencyValue.append(`<label>Valor comprado em Moeda de Destino: `+ data?.finalValue +`</label>`);
            descriptionPaymentFee.children().remove();
            descriptionPaymentFee.append(`<label>Taxa de Pagamento: `+ data?.methodPaymentFee +`</label>`);
            descriptionConversionFee.children().remove();
            descriptionConversionFee.append(`<label>Taxa de conversão: `+ data?.conversionFee +`</label>`);
            descriptionFinalValue.children().remove();
            descriptionFinalValue.append(`<label>Valor utilizado para conversão descontando as taxas: `+ data?.discountedValue +`</label>`);
            $('#description-quote').removeClass('d-none');
            buttonLoading.addClass('d-none');
            buttonSendQuote.show();
        }

        function translatePayment(paymentSlug) {
            payment['credit_card'] = 'Cartão de Crédito';
            payment['bank_invoice'] = 'Boleto';
            return payment[paymentSlug];
        }

        function setErrosParametersInvalids(response) {
            if (response.data?.errors?.money && inputMoney.hasClass('is-invalid') === false) {
                inputMoney.addClass('is-invalid');
                inputMoney.after( '<span class="invalid-feedback">' + response.data?.errors?.money + '</span>' );
            }

            if (response.data?.errors?.destination_currency && inputDestinationCurrency.hasClass('is-invalid') === false) {
                inputDestinationCurrency.addClass('is-invalid');
                inputDestinationCurrency.after( `<span class="invalid-feedback">` + response.data?.errors?.destination_currency + `</span>` );
            }

            if (response.data?.errors?.payment && payment.hasClass('is-invalid') === false) {
                payment.addClass('is-invalid');
                payment.after(`<span class="col-12 invalid-feedback">` + response.data?.errors?.payment + `</span>`);
            }
            buttonLoading.addClass('d-none');
            buttonSendQuote.show();
        }

        inputCreditCard.on('click', function () {
            if (payment.hasClass('is-invalid')) {
                payment.removeClass('is-invalid');
            }
            payload.payment = 'credit_card';
        });

        inputBankInvoice.on('click', function() {
            if (payment.hasClass('is-invalid')) {
                payment.removeClass('is-invalid');
            }
           payload.payment = 'bank_invoice';
        });

        inputDestinationCurrency.change('click', function(event) {
            if (inputDestinationCurrency.hasClass('is-invalid')) {
                inputDestinationCurrency.removeClass('is-invalid');
            }
            payload.destination_currency = event.target.value
        });

        inputMoney.on('input', function(event) {
           if (inputMoney.hasClass('is-invalid')) {
               inputMoney.removeClass('is-invalid');
           }

            var value = event.target.value;

            value = value + '';
            value = parseInt(value.replace(/[\D]+/g, ''));
            value = value + '';
            value = value.replace(/([0-9]{2})$/g, ",$1");

            if (value.length > 6) {
                value = value.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
            }

            event.target.value = value;
            if(value == 'NaN') event.target.value = '';

            payload.money = event.target.value.replace('.', '').replace(',', '.')
        });
    })
</script>
