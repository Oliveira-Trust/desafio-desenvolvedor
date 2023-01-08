<?php

namespace App\Services;

use App\Jobs\SendExchangeCreatedEmailJob;
use App\Models\Currency;
use App\Models\Exchange;
use App\Models\Fee;
use App\Models\PaymentMethod;
use App\Services\ApiConsume\AwesomeApi\ConversionApiService;
use App\Services\ApiConsume\AwesomeApi\DTO\CurrencyData;

class CreateExchangeService {

    private Currency      $origin_currency;
    private Currency      $destination_currency;
    private PaymentMethod $payment_method;

    public function __construct(
        private int $user_id,
        private int $origin_currency_id,
        private int $destination_currency_id,
        private int $payment_method_id,
        private float|int $origin_value,
        private ?string $email=null,
    ) {
        $this->origin_currency      = Currency::findOrFail($this->origin_currency_id);
        $this->destination_currency = Currency::findOrFail($this->destination_currency_id);
        $this->payment_method       = PaymentMethod::findOrFail($this->payment_method_id);
    }

    public function execute() {

        $destination_exchange_rate = $this->getExchangeCurrencyData()->high;
        $payment_method_fee_value  = $this->getPaymentMethodFeeValue();
        $exchange_fee_value        = $this->getExchangeFeeValue();
        $fees_value                = $exchange_fee_value + $payment_method_fee_value;
        $origin_value_without_fees = $this->origin_value - $fees_value;

        $purchased_value = $this->getPurchasedValue(
            origin_value_without_fees: $origin_value_without_fees,
            exchange_rate: $destination_exchange_rate
        );

        $exchange = $this->storeExchange(
            origin_value_without_fees: $origin_value_without_fees,
            purchased_value: $purchased_value,
            destination_exchange_rate: $destination_exchange_rate,
            payment_method_fee_value: $payment_method_fee_value,
            exchange_fee_value: $exchange_fee_value
        );

        if($this->email){
            $this->sendEmail($exchange, $this->email);
        }

        return $exchange;
    }

    private function getPurchasedValue(
        float $origin_value_without_fees,
        float $exchange_rate
    ): float {
        return round($origin_value_without_fees / $exchange_rate, 2);
    }

    private function getExchangeFeeValue(): float {

        $fee = Fee::orderBy('starting_value', 'desc')
                  ->where('starting_value', '<=', $this->origin_value)
                  ->first();

        if (!$fee) {
            return 0;
        }

        return (float) ($this->origin_value * $fee->fee_rate) / 100;
    }

    private function getPaymentMethodFeeValue(): float {
        return (float) ($this->origin_value * $this->payment_method->fee_rate) / 100;
    }

    private function storeExchange(
        float|int $origin_value_without_fees,
        float|int $purchased_value,
        float|int $destination_exchange_rate,
        float|int $payment_method_fee_value,
        float|int $exchange_fee_value,
    ): Exchange {

        $exchange = Exchange::create([
            'user_id'                   => $this->user_id,
            'origin_currency_id'        => $this->origin_currency_id,
            'destination_currency_id'   => $this->destination_currency_id,
            'payment_method_id'         => $this->payment_method_id,
            'origin_value'              => $this->origin_value,
            'origin_value_without_fees' => $origin_value_without_fees,
            'purchased_value'           => $purchased_value,
            'destination_exchange_rate' => $destination_exchange_rate,
            'payment_method_fee_value'  => $payment_method_fee_value,
            'exchange_fee_value'        => $exchange_fee_value,
        ]);

        return $exchange;
    }

    private function sendEmail(Exchange $exchange, $to) {

        $data = $exchange->load(['destinationCurrency', 'originCurrency', 'paymentMethod',])->toArray();

        SendExchangeCreatedEmailJob::dispatch($data, $to)
                                   ->onConnection('rabbitmq')
                                   ->onQueue('emails');
    }

    private function getExchangeCurrencyData(): CurrencyData {
        return app(ConversionApiService::class)->getCurrencyExchange(
            origin_currency_code: $this->origin_currency->code,
            destiny_currency_code: $this->destination_currency->code
        );
    }
}
