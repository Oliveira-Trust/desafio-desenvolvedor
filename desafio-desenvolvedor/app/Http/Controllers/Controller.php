<?php

namespace App\Http\Controllers;


class ConversionController extends Controller
{
    public function convert(Request $request)
    {
        $currency = $request->input('currency');
        $amount = $request->input('amount');
        $paymentMethod = $request->input('payment');

        if ($amount < 1000 || $amount > 100000) {
            return response()->json(['error' => 'O valor deve ser maior que R$ 1.000 e menor que R$ 100.000.'], 400);
        }

        $conversionRate = $this->getConversionRate($currency);
        $conversionFee = $amount < 3000 ? 0.02 * $amount : 0.01 * $amount;
        $paymentFee = $paymentMethod === 'boleto' ? 0.0145 * $amount : 0.0763 * $amount;

        $amountAfterFees = $amount - $conversionFee - $paymentFee;
        $convertedAmount = $amountAfterFees / $conversionRate;

        return response()->json([
            'destination_currency' => $currency,
            'amount' => $amount,
            'payment_method' => $paymentMethod,
            'conversion_rate' => $conversionRate,
            'converted_amount' => $convertedAmount,
            'payment_fee' => $paymentFee,
            'conversion_fee' => $conversionFee,
            'amount_after_fees' => $amountAfterFees
        ]);
    }

    private function getConversionRate($currency)
    {
        $response = file_get_contents("https://economia.awesomeapi.com.br/json/last/BRL-{$currency}");
        $data = json_decode($response, true);
        return $data["BRL{$currency}"]["ask"];
    }
}
