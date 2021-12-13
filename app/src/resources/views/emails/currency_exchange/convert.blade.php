@component('mail::message')
# Olá {{ $user->name }}! Segue abaixo o resultado da conversão de moedas

@component('mail::panel')

- **Moeda de Origem**: {{ $currencyExchangeLogs->origin_currency }}
- **Moeda de Destino**: {{ $currencyExchangeLogs->destination_currency }}
- **Valor para conversão**: {{ number_format($currencyExchangeLogs->origin_currency_value, 2, ',', '.') }}
- **Forma de pagamento**: {{ $currencyExchangeLogs->payment_method }}
- **Valor de {{ $currencyExchangeLogs->destination_currency }} usado para conversão**: {{ number_format($currencyExchangeLogs->destination_currency_base_value, 2, ',', '.') }}
- **Valor comprado em {{ $currencyExchangeLogs->destination_currency }}**: {{ number_format($currencyExchangeLogs->converted_value, 2, ',', '.') }}
- **Taxa de pagamento**: {{ number_format($currencyExchangeLogs->payment_tax, 2, ',', '.') }}
- **Taxa de conversão**: {{ number_format($currencyExchangeLogs->conversion_tax, 2, ',', '.') }}
- **Valor utilizado para conversão descontando as taxas**: {{ number_format($currencyExchangeLogs->origin_currency_net_value, 2, ',', '.') }}
@endcomponent

@endcomponent
