@php use App\Enums\PaymentType; @endphp

<div>
    <h1>{{ config('app.name') }}</h1>
    <br />
    <h2>Resultados da Cotação</h2>
    <hr>
    <p><strong>Moeda de origem:</strong><br /> {{ getSourceCurrency($currencyQuotation) }}</p>
    <p><strong>Moeda de destino:</strong><br /> {{ getDestinationCurrency($currencyQuotation) }}</p>
    <p><strong>Valor para conversão:</strong><br /> {{ $currencyQuotation?->conversion_value ? formatCurrencyValue($currencyQuotation?->conversion_value) : '' }}</p>
    <p><strong>Forma de Pagamento:</strong><br /> {{ $currencyQuotation?->payment_type ? PaymentType::getDescription($currencyQuotation?->payment_type) : '' }}</p>
    <p><strong>Valor de R$ 1,00 na moeda "{{  $currencyQuotation ? getDestinationCurrency($currencyQuotation) : 'Moeda de destino' }}" corresponde ao valor de:</strong><br /> {{ formatMoney($currencyQuotation?->bid, $currencyQuotation?->codein) }}</p>
    <p><strong>Valor comprado convertido em "{{ $currencyQuotation ? getDestinationCurrency($currencyQuotation) : 'Moeda de destino' }}":</strong><br /> {{ formatMoney($currencyQuotation->destination_currency_liquid_conversion_value, $currencyQuotation->codein) }}
        <span style="color: red;">{{ $currencyQuotation?->conversion_value ? '(taxas aplicadas no valor de compra diminuindo no valor total de conversão)' : '' }}</span></p>
    <p><strong>Taxa de pagamento:</strong><br /> {{ formatCurrencyValue($currencyQuotation?->payment_tax) }}</p>
    <p><strong>Taxa de conversão:</strong><br /> {{ formatCurrencyValue($currencyQuotation?->conversion_tax) }}</p>
    <p><strong>Valor utilizado para conversão descontando as taxas:</strong><br /> {{ formatCurrencyValue($currencyQuotation?->liquid_conversion_value) }}</p>
</div>
