<?php

namespace App\Services;

use App\Models\ConvertionFee;
use App\Models\PaymentMethod;

class ExchangeService
{
    public function applyFees(array $request_data, $quote)
    {
        $exchange = [
            'origin_currency'            => $quote[0]['codein'],
            'destination_currency'       => $quote[0]['code'],
            'value'                      => $request_data['value'],
            'payment_method'             => $request_data['payment_method'],
            'destination_currency_price' => $quote[0]['ask'],
        ];

        $exchange['payment_method_fee'] = $this->applyPaymentMethodFee(
            $exchange['payment_method'],
            $exchange['value']
        );

        $exchange['convertion_fee'] = $this->applyConvertionFee($exchange['value']);
        $exchange['discounted_value'] = $exchange['value'] - ($exchange['payment_method_fee'] + $exchange['convertion_fee']);
        $exchange['selling_price'] = $exchange['discounted_value'] / $exchange['destination_currency_price'];

        return $exchange;
    }

    private function applyPaymentMethodFee(string $slug, $value)
    {
        $payment_method = PaymentMethod::firstWhere('slug', $slug);

        return $value * $payment_method->fee / 100;
    }


    private function applyConvertionFee($value)
    {
        $convertion_fee = ConvertionFee::active()->first();

        if ($value <= $convertion_fee->base_value) {
            $fee = $convertion_fee->lt_fee;
        } elseif ($value >= $convertion_fee->base_value) {
            $fee = $convertion_fee->gt_fee;
        } else {
            $fee = 0;
        }

        return $value * $fee / 100;
    }
}
