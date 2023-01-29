<?php

namespace App\Services;

use App\Models\AmmountFee;
use App\Models\Exchange;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Http;

class ExchangeService
{
    public function create($currency, $method, $ammount) {

        $payment_method = PaymentMethod::where('method', $method)->first();
        $method_disc = $payment_method->fee;
        $ammount_disc = $this->getAmmountFee($ammount);
        $method_fee = ($ammount * $method_disc) / 100;
        $ammount_fee = ($ammount * $ammount_disc) / 100;
        $net_ammount = $ammount - $method_fee - $ammount_fee;
        $exchange_rate = $this->getCurrencyRate($currency);
        $converted_ammount = (float)number_format($net_ammount / $exchange_rate, 2);

        $payload = [
            'currency' => $currency,
            'method' => $method,
            'ammount' => $ammount,
            'ammount_fee' => $ammount_fee,
            'method_fee' => $method_fee,
            'net_ammount' => $net_ammount,
            'exchange_rate' => $exchange_rate,
            'converted_ammount' => $converted_ammount,
        ];

        return Exchange::create($payload);

    }

    private function getAmmountFee($ammount) {
        $ammount_fee = AmmountFee::where('ammount', '>=', $ammount)->orderBy('ammount')->first();
        if ($ammount_fee) {
            return $ammount_fee->fee;
        }
        $upper = AmmountFee::where('ammount', 0)->first();
        if ($upper) {
            return $upper->fee;
        }
        return 0;
    }

    private function getCurrencyRate($currency) {
        $url = config('desafio.base_api') . $currency . '-BRL';
        $response = Http::get($url);
        $body = $response->json();
        $bid = $body[$currency.'BRL']['bid'];
        return (float)$bid;
    }


}
