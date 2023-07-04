<?php

namespace App\Http\Controllers;

use App\Models\Conversion;
use App\Http\Infrastructure\Service\ExchangeRatesService;
use App\Http\Requests\ConversionRequest;


class ConversionController extends Controller
{
    public function convert(ConversionRequest $request)
    {
        $paramsToConversion = [
            'destinationCurrency'=>$request->input('destination_currency'),
            'conversionValue'=>$request->input('conversion_value'),
            'paymentMethod'=>$request->input('payment_method'),

        ];
       
        $resonseOfGetExchangeRate = $this->getExchangeRate($paramsToConversion['destinationCurrency']);
    
        if ($resonseOfGetExchangeRate->ok()) {
            $conversionRate = $resonseOfGetExchangeRate['BRL'.$paramsToConversion['destinationCurrency']['bid']];
            $this->calculateConversion($paramsToConversion, $conversionRate);
            
        } else {
            return response()->json(['error' => 'Failed to fetch conversion rate.'], 500);
        }
    }

    private function getExchangeRate($destinationCurrency): Object{

        $exchangeRateService = new ExchangeRatesService();
        return $exchangeRateService->getExchangeRates($destinationCurrency);

    }
    private function calculateConversion(Array $paramsToConversion, float $conversionRate){
        

        // Calcular o valor convertido
        $convertedValue = $paramsToConversion['conversionValue'] * $conversionRate;
        // Aplicar as taxas de pagamento
        $paymentRate = $paramsToConversion['paymentMethod'] == 'boleto' ? 0.0145 : 0.0763;
        $paymentFee = $convertedValue * $paymentRate;
        // Aplicar a taxa de conversão
        $conversionFee = $paramsToConversion['conversionValue'] < 3000 ? $paramsToConversion['conversionValue'] * 0.02 : $paramsToConversion['conversionValue'] * 0.01;
        // Calcular o valor total descontando as taxas
        $totalValue = $convertedValue - $paymentFee - $conversionFee;
        // Salvar a conversão no banco de dados
        $conversion = Conversion::create([
            'origin_currency' => 'BRL',
            'destination_currency' => $paramsToConversion['destinationCurrency'],
            'conversion_value' => $paramsToConversion['conversionValue'],
            'converted_value' => $convertedValue,
            'payment_method' => $paramsToConversion['paymentMethod'],
        ]);

            return response()->json([
                'conversion' => $conversion,
                'conversion_rate' => $conversionRate,
                'payment_fee' => $paymentFee,
                'conversion_fee' => $conversionFee,
                'total_value' => $totalValue,
            ]);
}
}
