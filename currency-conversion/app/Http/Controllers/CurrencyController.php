<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Services\CurrencyService;
use App\Services\ConversionService;

class CurrencyController extends Controller
{
    public function index() 
    {
        try {
            $currency = array('BRL', 'USD', 'EUR');

            return view('currency', compact('currency'));
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back();
        }
    }

    public function store(Request $request, ConversionService $conversionService) 
    {
        try {
            $request->validate([
                'value' => ['required', 'numeric'],
                'first_currency' => ['required'],
                'second_currency' => ['required'],
                'payment_method' => ['required'],
            ]);

            $value = $request->value;
            $firstCurrency = $request->first_currency;
            $secondCurrency = $request->second_currency;
            $paymentMethod = $request->payment_method;

            $conversionData = [
                'currencyToConvert' => $secondCurrency
            ];

            $valueDestinyCurrencyConverted = $conversionService->convert($conversionData);
            $valueWithPaymentMethodFeesToDiscount = $conversionService->paymentMethodFeeValue($value, $paymentMethod);
            $valueWithValueFeeToDiscount = $conversionService->conversionFeeValue($value);

            $dataToMountResult = [
                'originCurrency' => $firstCurrency,
                'destinyCurrency' => $secondCurrency,
                'valueToConvert' => $value,
                'paymentMethodFee' => $valueWithPaymentMethodFeesToDiscount,
                'conversionFee' => $valueWithValueFeeToDiscount,
                'paymentMethod' => $paymentMethod,
                'valueDestinyCurrencyConverted' => $valueDestinyCurrencyConverted,
            ];

            $viewData = $conversionService->mountResult($dataToMountResult);

        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }

        return view('currency', compact('viewData'));

        // enviar email
        // salvar log
    }
}
