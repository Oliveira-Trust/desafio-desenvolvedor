<x-mail::message>
# Olá, {{ $exchange->user->name }}!

## Uma nova conversão foi realizada.

<x-mail::table>
| MOEDA (ORIGEM)                          | MOEDA (DESTINO)                              | VALOR PARA CONVERSÃO                    | FORMA DE PAGAMENTO                          | VALOR DA MOEDA (DESTINO)                               | VALOR CONVERTIDO                      | TAXA (FORMA DE PAGAMENTO)                  | TAXA (DE CONVERSÃO)                    | VALOR DESCONTADO                                                          |
|:---------------------------------------:|:--------------------------------------------:|:---------------------------------------:|:-------------------------------------------:|:------------------------------------------------------:|:-------------------------------------:|:------------------------------------------:|:--------------------------------------:|:-------------------------------------------------------------------------:|
| {{ $exchange->source_currency }} | {{ $exchange->destination_currency }} | {{ $exchange->original_amount }} | {{ $exchange->paymentMethod->name }} | {{ $exchange->amount_in_destination_currency }} | {{ $exchange->total_with_fees }} | {{ $exchange->payment_method_fee }} | {{ $exchange->conversion_fee }} | {{ $exchange->payment_method_fee + $exchange->conversion_fee }} |
</x-mail::table>

Atenciosamente,<br>
{{ config('app.name') }}
</x-mail::message>
