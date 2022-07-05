@component('mail::message')
# Olá, {{ $user_history->user->name }}!

## Uma nova conversão foi realizada.

@component('mail::table')
| MOEDA (ORIGEM)                       | MOEDA (DESTINO)                           | VALOR PARA CONVERSÃO       | FORMA DE PAGAMENTO                  | VALOR DA MOEDA (DESTINO)                        | VALOR CONVERTIDO                   | TAXA (FORMA DE PAGAMENTO)               | TAXA (DE CONVERSÃO)                 | VALOR DESCONTADO                      |
|:------------------------------------:|:-----------------------------------------:|:--------------------------:|:-----------------------------------:|:-----------------------------------------------:|:----------------------------------:|:---------------------------------------:|:-----------------------------------:|:-------------------------------------:|
| {{ $user_history->origin_currency }} | {{ $user_history->destination_currency }} | {{ $user_history->value }} | {{ $user_history->payment_method }} | {{ $user_history->destination_currency_price }} | {{ $user_history->selling_price }} | {{ $user_history->payment_method_fee }} | {{ $user_history->convertion_fee }} | {{ $user_history->discounted_value }} |
@endcomponent

Atenciosamente,<br>
{{ config('app.name') }}
@endcomponent
