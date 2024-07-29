<?php

namespace App\Services;

use App\Enum\PaymentMethod;
use App\Models\TaxSettings;

class QuotationService
{
    public static function getQuotation($request): array
    {

        $taxSettings = TaxSettings::where('user_id', auth()->user()->id)->first();

        $quotation = AwesomeApiService::exchange($request->source_currency, $request->target_currency);
        $exchangeRate = $quotation[$request->source_currency.$request->target_currency]['bid'];


        $paymentFee = 0;
        $conversionFee = 0;

        $originalAmount = sanitizaNumbers( $request->original_amount);

        if ($request->payment_method == PaymentMethod::boleto_fee->value) {
            $paymentFee = $originalAmount * ($taxSettings->boleto_fee / 100);
        } elseif ($request->payment_method == PaymentMethod::credit_card_fee->value) {
            $paymentFee = $originalAmount * ($taxSettings->credit_card_fee / 100);
        }

        if ($originalAmount < 3000) {
            $conversionFee = $originalAmount * ($taxSettings->conversion_fee_below_3000 / 100);
        } else {
            $conversionFee = $originalAmount * ($taxSettings->conversion_fee_above_3000 / 100);
        }

        $amountAfterFees = $originalAmount - $paymentFee - $conversionFee;

        $convertedAmount = $amountAfterFees * $exchangeRate;
        $valueTargetCurrency = $amountAfterFees / $convertedAmount;


        return [
            'value_target_currency' =>  number_format($valueTargetCurrency, 2, '.', ''),
            'converted_amount' => number_format($convertedAmount, 2, '.', ''),
            'payment_fee' => number_format($paymentFee, 2, '.', ''),
            'conversion_fee' => number_format($conversionFee, 2, '.', ''),
            'final_amount' => number_format($amountAfterFees, 2, '.', ''),
        ];
    }

    public static function validateAvailability($request): bool
    {
        $available = AwesomeApiService::getAvailable();

        return in_array("{$request->source_currency}-{$request->target_currency}" ,array_keys($available));
    }
}
