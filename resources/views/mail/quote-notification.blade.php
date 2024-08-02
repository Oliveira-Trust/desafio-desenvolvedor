<x-mail::message>
# Aqui está a sua cotacão.


<x-mail::table>
    |                                |                            |
    | :----------------------------- | -------------------------: |
    | Moeda de Origem                | {{ $origin_currency }} |
    | Moeda de Destino               | {{ $destination_currency }} |
    | Valor para Conversão           | R$ {{ number_format($amount, 2, ',', '.') }} |
    | Forma de Pagamento             | {{ $payment_title }} |
    | Preço de Compra                | {{ App\Enums\Currencies::symbol($destination_currency) }} {{ number_format($purchase_price, 2, ',', '.') }} |
    | Valor da Moeda de Destino      | R$ {{ number_format($destination_value, 2, ',', '.') }} |
    | Valor Comprado                 | {{ App\Enums\Currencies::symbol($destination_currency) }} {{ number_format($converted_value, 2, ',', '.') }} |
    | Taxa de Pagamento              | R$ {{ number_format($payment_tax, 2, ',', '.') }} |
    | Taxa de Conversão              | R$ {{ number_format($conversion_tax, 2, ',', '.') }} |
    | Valor Utilizado para Conversão | R$ {{ number_format($converted_amount, 2, ',', '.') }} |
</x-mail::table>

Obrigado,<br>
{{ config('app.name') }}
</x-mail::message>
