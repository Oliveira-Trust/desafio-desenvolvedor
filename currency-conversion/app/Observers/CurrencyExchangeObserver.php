<?php

namespace App\Observers;

use App\Models\CurrencyExchange;

use App\Notifications\SendQuote;
use Illuminate\Support\Facades\Notification;

class CurrencyExchangeObserver
{

  public function created(CurrencyExchange $currencyExchange)
  {
    $user = $currencyExchange->user;
    $user->initial_conversion_value = $currencyExchange->initial_conversion_value;
    $user->coin_exchange_from = $currencyExchange->coin_exchange_from;
    $user->coin_exchange_to = $currencyExchange->coin_exchange_to;
    $user->form_of_payment = $currencyExchange->form_of_payment;
    $user->target_currency_value = $currencyExchange->target_currency_value;
    $user->target_currency_purchased = $currencyExchange->target_currency_purchased;
    $user->payment_rate = $currencyExchange->payment_rate;
    $user->conversion_rate = $currencyExchange->conversion_rate;
    $user->final_conversion_value = $currencyExchange->final_conversion_value;
    Notification::send($user, new SendQuote);
  }

  public function updated(CurrencyExchange $currencyExchange)
  {
    $user = $currencyExchange->user;
    $user->initial_conversion_value = $currencyExchange->initial_conversion_value;
    $user->coin_exchange_from = $currencyExchange->coin_exchange_from;
    $user->coin_exchange_to = $currencyExchange->coin_exchange_to;
    $user->form_of_payment = $currencyExchange->form_of_payment;
    $user->target_currency_value = $currencyExchange->target_currency_value;
    $user->target_currency_purchased = $currencyExchange->target_currency_purchased;
    $user->payment_rate = $currencyExchange->payment_rate;
    $user->conversion_rate = $currencyExchange->conversion_rate;
    $user->final_conversion_value = $currencyExchange->final_conversion_value;
    Notification::send($user, new SendQuote);
  }

}
