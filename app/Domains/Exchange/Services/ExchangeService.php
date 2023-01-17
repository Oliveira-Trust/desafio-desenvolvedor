<?php

namespace App\Domains\Exchange\Services;

use App\Domains\Exchange\DTO\ExchangeDTO;
use App\Domains\Exchange\Interfaces\IExchangeConvert;
use App\Domains\Exchange\Models\Currency;
use App\Domains\Exchange\Models\Exchange;
use App\Domains\Exchange\Models\ExchangeFee;
use App\Domains\PaymentMethod\Services\PaymentMethodService;

class ExchangeService
{
    public function __construct(public IExchangeConvert $exchangeConvert, public PaymentMethodService $paymentMethodService)
    {

    }

    function createExchange(ExchangeDTO $exchangeDTO)
    {
        $currency_from = Currency::find($exchangeDTO->currency_id_from);

        if($currency_from->code !== "BRL"){
            throw new \Exception("A moeda a ser convertida precisa ser BRL");
        }

        $payment_method_fee = $this->paymentMethodService->getFee($exchangeDTO->payment_method_id);

        $exchange_fee = ExchangeFee::findByAmount($exchangeDTO->amount)->fee;

        $exchange_fee_amount = bcmul($exchangeDTO->amount, $exchange_fee);
        $payment_fee_amount = bcmul($exchangeDTO->amount, $payment_method_fee);

        $total_fee_amount = bcadd($payment_fee_amount, $exchange_fee_amount);
        $amount_from_net = bcsub($exchangeDTO->amount, $total_fee_amount);

        $conversionResult = $this->exchangeConvert->currencyExchange($exchangeDTO->currency_id_from, $exchangeDTO->currency_id_to, $amount_from_net);

        $exchange = Exchange::create([
            "currency_id_to" => $exchangeDTO->currency_id_to,
            "currency_id_from" => $exchangeDTO->currency_id_from,
            "payment_method_id" => $exchangeDTO->payment_method_id,
            "amount_from" => $exchangeDTO->amount,
            "amount_from_net" => $amount_from_net,
            "bid_amount" => $conversionResult->amount_bid,
            "amount_to_net" => $conversionResult->amount_convert_to,
            "exchange_fee_amount" => $exchange_fee_amount,
            "payment_method_fee_amount" => $payment_fee_amount,
            "user_id" => $exchangeDTO->user_id
        ]);

        return Exchange::find($exchange->id);
    }

    public function listExchange($user_id)
    {
        return Exchange::where("user_id", $user_id)->get();
    }
}
