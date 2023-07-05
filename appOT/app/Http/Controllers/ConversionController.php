<?php

namespace App\Http\Controllers;

use App\Http\Infrastructure\Service\ExchangeRatesService;
use App\Http\Requests\ConversionRequest;
use Illuminate\Http\Request;
use App\Http\Application\UseCases\ConversionUseCase;



class ConversionController extends Controller
{
    private ConversionUseCase $ConversionUseCase;

    public function __construct(ConversionUseCase $ConversionUseCase)
    {
        $this->ConversionUseCase = $ConversionUseCase;
    }
    public function convert(ConversionRequest $request)
    {

       
        
        $paramsToConversion = [
            'origin_currency' =>'BLR',
            'destinationCurrency'=>$request->input('destination_currency'),
            'conversionValue'=>$request->input('conversion_value'),
            'paymentMethod'=>$request->input('payment_method'),

        ];

        $resonseOfGetExchangeRate = $this->getExchangeRate($paramsToConversion['destinationCurrency']);
    
        if ($resonseOfGetExchangeRate->ok()) {
   
            $conversionRate = $resonseOfGetExchangeRate['BRL'.$paramsToConversion['destinationCurrency']]['bid'];
            $converted_value = $this->calculateConversion($paramsToConversion, $conversionRate );
           
            $conversion = $this->ConversionUseCase->execute(
                $paramsToConversion['origin_currency'],  $paramsToConversion['destinationCurrency'], 
                $paramsToConversion['conversionValue'], $converted_value, $paramsToConversion['paymentMethod']
            );
            return $conversion;
            
        } else {
            return response()->json(['error' => 'Failed to fetch conversion rate.'], 500);
        }
    }


    public function getHistoryByUser(Request $request, $userid)
    {
           
            $conversions = $this->ConversionUseCase->getConversionHistorybyUserId($userid);
            
        
            return $conversions;
            
        
    }


    private function getExchangeRate($destinationCurrency): Object{

        $exchangeRateService = new ExchangeRatesService();
        return $exchangeRateService->getExchangeRates($destinationCurrency);

    }
    private function calculateConversion(Array $paramsToConversion, float $conversionRate){
        
        $convertedValue = $paramsToConversion['conversionValue'] * $conversionRate;
        $paymentRate = $paramsToConversion['paymentMethod'] == 'boleto' ? 0.0145 : 0.0763;
        $paymentFee = $convertedValue * $paymentRate;
        $conversionFee = $paramsToConversion['conversionValue'] < 3000 ? $paramsToConversion['conversionValue'] * 0.02 : $paramsToConversion['conversionValue'] * 0.01;
        $totalValue = $convertedValue - $paymentFee - $conversionFee;
        return $totalValue;
    }
}
