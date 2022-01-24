@component('mail::message')
# Olá!

Você recentemente realizou uma cotação em nossa plataforma, e estamos te enviando este email para confirmar o recebimento. Segue abaixo os dados da cotação:

Moeda de origem: {{ $quote->origin_currency }}

Moeda de destino: {{ $quote->destination_currency }}

Valor original: {{ (new App\Support\Money($quote->amount))->format('BRL') }}

Forma de pagamento: {{ __($quote->payment_method) }}

Valor convertido: {{ (new App\Support\Money($quote->amount_received))->format($quote->destination_currency) }}

Taxa de pagamento: {{ (new App\Support\Money($quote->payment_method_fee))->format('BRL') }}

Taxa de conversão: {{ (new App\Support\Money($quote->conversion_fee))->format('BRL') }}

Valor utilizado para conversão descontando as taxas: {{ (new App\Support\Money($quote->amount_converted))->format('BRL') }}

Atenciosamente,<br>
{{ config('app.name') }}
@endcomponent
