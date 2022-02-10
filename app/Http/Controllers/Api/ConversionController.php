<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FormConversionRequest;
use App\Services\CurrencyConversionSevice;
use Illuminate\Http\JsonResponse;

class ConversionController extends Controller
{

    public function index(): JsonResponse
    {
        return response()->json([
            'message' => 'Welcome to the currency conversion'
        ]);
    }

    public function run(FormConversionRequest $request): JsonResponse
    {
        $service = resolve(CurrencyConversionSevice::class);
        $payload = $request->only(['initial_currency', 'final_currency', 'amount_to_convert', 'payment_method']);

        $convertedAmount = $service->run($payload);

        if (!$convertedAmount) {
            return response()->json([
                'message' => "A combinação escolhida não está disponível no momento."
            ], 404);
        }

        return response()->json([
            'message' => "Valor convertido com sucesso!",
            'requested_at' => date("Y-m-d H:i:s"),
            'result' => [
                'initialCurrency' => $payload['initial_currency'],
                'finalCurrency' => $payload['final_currency'],
                'amountToConvert' => number_format($payload['amount_to_convert'], 2, ",", ".") . " " . $payload['initial_currency'],
                'paymentMethod' => $payload['payment_method'],
                'bidOnConversion' => number_format($convertedAmount['bidOnConversion'], 2, ",", ".") . " " . $payload['final_currency'],
                'convertedAmount' => $convertedAmount['convertedAmount'],
                'paymentTax' => $service->getTaxes($payload)['paymentTax'] . " " . $payload['initial_currency'],
                'conversionTax' => $service->getTaxes($payload)['conversionTax'] . " " . $payload['initial_currency'],
                'amountWithTaxes' => $convertedAmount['amountWithTaxes']
            ]
        ]);
    }
}
