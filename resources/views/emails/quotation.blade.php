<x-mail::message>
# Cotação
    {{ $user }}, segue a cotação que realizou conosco.

    Moeda de destino: {{ $quotation->destination_currency }}.<br>
    Cotação: R$ {{ $quotation }}.<br>
    Taxa de pagamento: R$ {{ $paymentTax }}.<br>
    Taxa de conversão: R$ {{ $conversionTax }}.<br>
    Valor bruto para conversão: R$ {{ $conversionAmount }}.<br>
    Valor líquido para conversão: R$ {{ $conversionNetAmount }}.<br>
    Total convertido : {{ $destinationCurrencyAvailable }}.<br>

Atenciosamente<br>
{{ config('app.name') }}
</x-mail::message>
