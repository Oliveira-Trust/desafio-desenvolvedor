@component('mail::message')
    <p>Moeda Origem: BRL</p>
    <p>Moeda Destino: {{ $quote->currency_to }}</p>
    <p>Valor da Moeda: {{ $quote->bid }}</p>
    <p>Valor informado: {{ $quote->currency_from }}</p>
    <p>Valor Quotado: {{ $quote->quote_value }}</p>
@endcomponent
