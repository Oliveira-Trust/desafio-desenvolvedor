@extends('panel.template.panel')

@section('title-page')
    Configurações de Taxas de Conversão
@endsection

@section('content')
    <div class="row">

        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Configurações</h3></div>
                <div class="panel-body">
                    @include('shared.errors')

                    @include('shared.alerts')
                    <form action="{{ route('saveCurrencyExchangeSettings') }}" method="POST" id="currencySettingsForm">
                        @csrf

                        <div class="form-group @error('boleto_payment_tax') has-error @enderror">
                            <label for="boleto_payment_tax" class="control-label">Taxa do boleto</label>
                            <input type="text" class="form-control @error('boleto_payment_tax') field-error @enderror" value="{{ old('boleto_payment_tax') ?? $settings?->boleto_payment_tax }}"
                                id="boleto_payment_tax" name="boleto_payment_tax" placeholder="Informe a taxa para pagamento em boleto..." maxlength="6">
                            <x-errors-field field="boleto_payment_tax" />
                        </div>
                        <div class="form-group @error('credit_card_payment_tax') has-error @enderror">
                            <label for="credit_card_payment_tax" class="control-label">Taxa do cartão de crédito</label>
                            <input type="text" class="form-control @error('credit_card_payment_tax') field-error @enderror" value="{{ old('credit_card_payment_tax') ?? $settings?->credit_card_payment_tax }}"
                                id="credit_card_payment_tax" name="credit_card_payment_tax" placeholder="Informe a taxa para pagamento em cartão de crédito..." maxlength="6">
                            <x-errors-field field="credit_card_payment_tax" />
                        </div>
                        <div class="form-group @error('base_value_conversion_tax') has-error @enderror">
                            <label for="base_value_conversion_tax" class="control-label">Valor base para taxa de conversão</label>
                            <input type="text" class="form-control @error('base_value_conversion_tax') field-error @enderror" value="{{ old('base_value_conversion_tax') ?? $settings?->base_value_conversion_tax }}"
                                   id="base_value_conversion_tax" name="base_value_conversion_tax" placeholder="Informe o valor base para taxa de conversão..." maxlength="12">
                            <x-errors-field field="base_value_conversion_tax" />
                        </div>
                        <div class="form-group @error('base_value_lower_conversion_tax') has-error @enderror">
                            <label for="base_value_lower_conversion_tax" class="control-label">Taxa de conversão para valores menores ou iguais que o valor base</label>
                            <input type="text" class="form-control @error('base_value_lower_conversion_tax') field-error @enderror" value="{{ old('base_value_lower_conversion_tax') ?? $settings?->base_value_lower_conversion_tax }}"
                                   id="base_value_lower_conversion_tax" name="base_value_lower_conversion_tax" placeholder="Informe a taxa de conversão para valores menores..." maxlength="6">
                            <x-errors-field field="base_value_lower_conversion_tax" />
                        </div>
                        <div class="form-group @error('base_value_greater_conversion_tax') has-error @enderror">
                            <label for="base_value_greater_conversion_tax" class="control-label">Taxa de conversão para valores maiores que o valor base</label>
                            <input type="text" class="form-control @error('base_value_greater_conversion_tax') field-error @enderror" value="{{ old('base_value_greater_conversion_tax') ?? $settings?->base_value_greater_conversion_tax }}"
                                   id="base_value_greater_conversion_tax" name="base_value_greater_conversion_tax" placeholder="Informe a taxa de conversão para valores maiores..." maxlength="6">
                            <x-errors-field field="base_value_greater_conversion_tax" />
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-success waves-effect waves-light btn-lg" id="currencySettingsButton">Salvar</button>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        </div>
                    </form>
                </div><!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col-->
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/common/js/jquery.maskMoney.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#base_value_conversion_tax').maskMoney({ prefix:'R$ ', decimal: ',', thousands: '.' });
            $('#boleto_payment_tax,#credit_card_payment_tax,#base_value_greater_conversion_tax,#base_value_lower_conversion_tax').maskMoney({ decimal: ',', thousands: '.', suffix: '%'});

            $('#currencySettingsButton').click(function() {
                $(this).text('carregando...').prop('disabled', true);

                // Submit the form or perform other actions
                $('#currencySettingsForm').submit();

                $('#boleto_payment_tax,#credit_card_payment_tax,#base_value_conversion_tax,#base_value_greater_conversion_tax,#base_value_lower_conversion_tax')
                    .prop('disabled', true);
            });
        });
    </script>
@endsection
