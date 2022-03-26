<?php

namespace App\Services;

use App\Models\Currency;
use App\Models\CurrencyPurchase;
use App\Rest\AwesomeApiQuoteCurrency;

class CurrencyService
{

    public function getPurchases(array $data = [])
    {
        return CurrencyPurchase::query()->search($data)->get();
    }

    public function getCurrencies(array $data = [])
    {
        return Currency::query()->search($data)->get();
    }

    public function buyCurrency(array $data)
    {
        return $this->fillCurrencyData(new CurrencyPurchase(), $data)->save();
    }

    public function getConvertedCurrency(array $data)
    {
        return $this->fillCurrencyData(new CurrencyPurchase(), $data);
    }

    public function fillCurrencyData(CurrencyPurchase $currencyPurchase, array $data)
    {
        $currencyPurchase->fill($data);

        $convertionFeeValue = $this->calcConvertionFee($currencyPurchase->origin_currency_value);
        $paymentFeeValue = $this->calcPaymentFee($currencyPurchase->origin_currency_value, $currencyPurchase->paymentType->fee);
        $convertedCurrency = $this->convertCurrency(
            $currencyPurchase->origin_currency,
            $currencyPurchase->destinationCurrency->symbol,
            $currencyPurchase->origin_currency_value - $convertionFeeValue - $paymentFeeValue
        );

        $currencyPurchase->fill([
            'user_id' => auth()->user()->id,
            'converted_currency_value' => $convertedCurrency['result'],
            'destination_currency_price' => $convertedCurrency['price'],
            'convertion_fee' => $this->getConvertionFee($currencyPurchase->origin_currency_value),
            'convertion_fee_value' => $convertionFeeValue,
            'payment_fee' => $currencyPurchase->paymentType->fee,
            'payment_fee_value' => $paymentFeeValue
        ]);

        return $currencyPurchase;
    }

    public function convertCurrency($originCurrencySymbol, $destinationCurrencySymbol, $originCurrencyValue)
    {
        $awesomeApiQuoteCurrency = new AwesomeApiQuoteCurrency;
        $response = $awesomeApiQuoteCurrency->lastCurrencyPrice($destinationCurrencySymbol, $originCurrencySymbol);
        $purchasePrice = data_get($response, $destinationCurrencySymbol . $originCurrencySymbol . '.bid');
        return [
            'price' => $purchasePrice,
            'result' => $originCurrencyValue / $purchasePrice
        ];
    }

    public function calcPaymentFee($originCurrencyValue, $fee)
    {
        return $originCurrencyValue * $fee / 100;
    }

    public function calcConvertionFee($originCurrencyValue)
    {
        return $originCurrencyValue * $this->getConvertionFee($originCurrencyValue) / 100;
    }

    public function getConvertionFee($originCurrencyValue)
    {
        return $originCurrencyValue < 3000 ? 2 : 1;
    }

}
