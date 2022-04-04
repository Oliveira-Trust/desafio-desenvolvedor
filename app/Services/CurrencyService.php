<?php

namespace App\Services;

use App\Mail\BuyCurrency;
use App\Models\Currency;
use App\Models\CurrencyPurchase;
use App\Models\CurrencyPurchaseConversionFee;
use App\Rest\AwesomeApiQuoteCurrency;
use Illuminate\Support\Facades\Mail;

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
        $currencyData = $this->fillCurrencyData(new CurrencyPurchase(), $data);
        $saved = $currencyData->save();
        $currencyData->conversionFees->each(function($conversion) use($currencyData){
            $conversion->fill(['currency_purchase_id' => $currencyData->id])->save();
        });

        Mail::to(auth()->user()->email)->send(new BuyCurrency($currencyData));
        return $saved;
    }

    public function getConvertedCurrency(array $data)
    {
        return $this->fillCurrencyData(new CurrencyPurchase(), $data);
    }

    public function fillCurrencyData(CurrencyPurchase $currencyPurchase, array $data)
    {
        $currencyPurchase->fill($data);

        $conversionFees = $this->applyConvertionFees($currencyPurchase->origin_currency_value);
        $currencyPurchase->setRelation('conversionFees', $conversionFees);

        $convertionFeeValue = $conversionFees->reduce(function($carry, $item) {
            $carry += $item->convertion_fee_value;
            return $carry;
        });

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
            'payment_fee' => $currencyPurchase->paymentType->fee,
            'payment_fee_value' => $paymentFeeValue
        ]);

        return $currencyPurchase;
    }

    public function convertCurrency($originCurrencySymbol, $destinationCurrencySymbol, $originCurrencyValue)
    {
        $awesomeApiQuoteCurrency = new AwesomeApiQuoteCurrency;
        $response = $awesomeApiQuoteCurrency->lastCurrencyPrice($destinationCurrencySymbol, $originCurrencySymbol);
        $purchasePrice = data_get($response,
            $destinationCurrencySymbol . $originCurrencySymbol . '.bid',
            data_get($response, $destinationCurrencySymbol . '.bid', 1)
        );

        return [
            'price' => $purchasePrice,
            'result' => $originCurrencyValue / $purchasePrice
        ];
    }

    public function calcPaymentFee($originCurrencyValue, $fee)
    {
        return $originCurrencyValue * $fee / 100;
    }

    public function applyConvertionFees($originCurrencyValue)
    {
        $conversionFees = app(ConversionFeeService::class)->getConversionFees(['status' => true]);
        return $conversionFees->map(function($conversionFee) use($originCurrencyValue){
            if($this->getConvertionFee($originCurrencyValue, $conversionFee)) {
                $currencyPurchaseConversionFee = new CurrencyPurchaseConversionFee();
                $currencyPurchaseConversionFee->fill([
                    'conversion_fee_id' => $conversionFee->id,
                    'convertion_fee' => $conversionFee->fee,
                    'convertion_fee_value' => $originCurrencyValue * $conversionFee->fee / 100,
                    'conversion_rule' => __('enum.' . $conversionFee->comparison_operator) . ' R$ ' . number_format($conversionFee->comparator_value * 1, 2, ',', '')
                ]);
                return $currencyPurchaseConversionFee;
            }
        })->filter(function($conversionFee){ return $conversionFee !== null; });
    }

    public function getConvertionFee($originCurrencyValue, $conversionFee)
    {
        $comparatorCode = "return (($originCurrencyValue $conversionFee->comparison_operator $conversionFee->comparator_value) ? $conversionFee->fee : 0);";
        return eval($comparatorCode);
    }
}
