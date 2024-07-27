<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ConversionService;
use App\Http\Requests\ValidateRequest;

class ConversionController extends Controller
{
    /**
     * The function is a PHP constructor that initializes a private property with a ConversionService
     * object injected through dependency injection.
     */
    public function __construct(
        private ConversionService $currencyService
    ) {
        $this->currencyService = $currencyService;
    }

    /**
     * The `show` function in PHP returns a view named 'conversion'.
     * 
     * @return A view named 'conversion' is being returned.
     */
    public function show()
    {
        return view('conversion');
    }

    /**
     * The function `convert` processes a validated request for currency conversion, calculates fees
     * and exchange rates, and returns a JSON response with the conversion details.
     * 
     * @param ValidateRequest request It looks like you have a PHP function that converts currency
     * based on a request object. The function takes a `ValidateRequest` object as a parameter and
     * performs various calculations to convert the currency.
     * 
     * @return a JSON response with the following structure:
     * ```json
     * {
     *     "success": true,
     *     "data": {
     *         "fromCurrency": "The currency from which the conversion is made",
     *         "toCurrency": "The currency to which the conversion is made",
     *         "valueToConversion": "The original amount to be converted",
     *         "paymentType": "The payment method
     */
    public function convert(ValidateRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->amount < 1000 || $request->amount > 100000) {
            return response()->json([
                    'error' => 'Valor da Compra em BRL (deve ser maior que R$ 1.000,00 e menor que R$ 100.000,00)'
                ], 400);
        }

        $rate   = $this->currencyService->calcExchangeRates($request);
        $resultExchangeRates    = ($request->amount / $rate);

        $feeWithoutPaymentType  = $this->currencyService->calcfeeWithoutPaymentType($request, $resultExchangeRates);
        $totalFee               = $this->currencyService->calcTotalFeeByTypePayment($request, $feeWithoutPaymentType);

        $feePayment             = ($totalFee - $resultExchangeRates) * $rate;
        $feeConversion          = ($feeWithoutPaymentType - $resultExchangeRates) * $rate;
        $conversionWithoutFee   = (($resultExchangeRates * $rate) - $feePayment) - $feeConversion;
        $purchasedValue         = $resultExchangeRates - ($feePayment/$rate) - ($feeConversion/$rate);
        
        return response()->json([
            'success' => true,
            'data' => [
                "fromCurrency"          => $request->from_currency,
                "toCurrency"            => $request->to_currency,
                "valueToConversion"     => number_format($request->amount, 2, ',','.'),
                "paymentType"           => $request->payment_method,
                "usedValueToConversion" => number_format($rate, 2,'.',''),
                "purchasedValue"        => $request->to_currency !== "BTC" 
                    ? number_format($purchasedValue, 2, ',','.') 
                    : number_format($purchasedValue, 6, ',','.'),
                "feePayment"            => number_format($feePayment, 2, ',','.'),
                "feeConversion"         => number_format($feeConversion, 2, ',','.'),
                "conversionWithoutFee"  => number_format($conversionWithoutFee, 2, ',','.')  
            ]
        ]);    
    }
}