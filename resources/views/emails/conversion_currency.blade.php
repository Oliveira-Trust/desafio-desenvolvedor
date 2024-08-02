<x-mail::message>
# Conversor de Moeda

Olá, {{ $user->name }}.

Aqui está a sua última conversão:

* **De Real para {{$currencyConversion->destination_currency}}**
* Método de Pagamento: {{$currencyConversion->payment_method->name}}
* Valor de R$ 1,00 convertido em {{$currencyConversion->destination_currency}}: {{ $currencyConversion->value_currency_conversion }}
* Valor usado para conversão: R$ {{ $currencyConversion->value_conversion }}
* Taxa de Pagamento: R${{ $currencyConversion->payment_rate }}
* Taxa de Conversão: R$ {{ $currencyConversion->conversion_rate }}
* Valor final: R$ {{ $currencyConversion->amount_conversions_subtracting_fees }}
* Valor comprado: {{$currencyConversion->destination_currency}} {{ $currencyConversion->purchased_value_currency }}


Obrigado,<br>
{{ config('app.name') }}
</x-mail::message>
