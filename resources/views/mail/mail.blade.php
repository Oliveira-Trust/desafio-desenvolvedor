<div class="col-md-6 d-none" id="description-quote">
    <div class="card">
        <div class="card-header">Descrição da cotação</div>
        <div class="card-body">
            <div class="row ml-1">
                <label>Moeda de Origem: Real Brasileiro (BRL)</label>
            </div>
            <div class="row ml-1" id="description-currency-label">
                <label>Moeda de Destino: {{ $data->currency }}</label>
                <label>{{ $data->currency }}</label>
                <label>{{ $data->currency }}</label>
            </div>
            <div class="row ml-1" id="description-value">
                <label>Valor para Conversão: {{ $data->value }}</label>
            </div>
            <div class="row ml-1" id="description-payment-label">
                <label>Forma de pagamento: {{ $data->methodPayment }}</label>
            </div>
            <div class="row ml-1" id="description-currency-price">
                <label>Valor da Moeda de Destino: {{ $data->priceCurrency }}</label>
            </div>
            <div class="row ml-1" id="description-currency-value">
                <label>Valor comprado em Moeda de Destino: {{ $data->finalValue }}</label>
            </div>
            <div class="row ml-1" id="description-payment-fee">
                <label>Taxa de Pagamento: {{ $data->methodPaymentFee }}</label>
            </div>
            <div class="row ml-1" id="description-conversion-fee">
                <label>Taxa de conversão: {{ $data->conversionFee }}</label>
            </div>
            <div class="row ml-1" id="description-final-value">
                <label>Valor utilizado para conversão descontando as taxas: {{ $data->discountedValue  }}</label>
            </div>
        </div>
    </div>
</div>