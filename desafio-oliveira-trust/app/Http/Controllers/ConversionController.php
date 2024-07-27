<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurrencyConversionRequest;
use App\Services\CurrencyConversionService;

class ConversionController extends Controller
{   protected $conversionService;
    public function __construct(CurrencyConversionService $conversionService)
    {
        $this->conversionService = $conversionService;
    }
    public function index()
    {
        return view('conversion');
    }
    public function convert(CurrencyConversionRequest $request)  
    {                  
        $currency = $request->input('currency');
        $amount = $request->input('amount');
        $payment_method = $request->input('payment_method');

       //obtem taxa de conversão
       $convertion_rate = $this->conversionService->getConversionRate($currency);
       //calcula as taxas
       $fees = $this->conversionService->calculateFees($amount, $payment_method);
       //calcula o valor convertido 
       $converted_amount = $this->conversionService->convert($convertion_rate, $fees);

        return view('conversion_result', [
            'currency' => $currency,
            'amount' => $amount,
            'payment_method' => $payment_method,
            'conversion_rate' => $convertion_rate,
            'converted_amount' => $converted_amount,
            'payment_fee_amount' => $fees['payment_fee_amount'],
            'conversion_fee_amount' => $fees['conversion_fee_amount'],
            'net_amount' => $fees['net_amount'],
        ]);

    }
}
