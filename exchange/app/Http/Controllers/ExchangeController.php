<?php

namespace App\Http\Controllers;

use App\Models\Exchange;
use App\Services\ExchangeService;
use Illuminate\Http\Request;

class ExchangeController extends Controller
{
    public function __construct(private ExchangeService $exchangeService)
    {
        $this->exchangeService = $exchangeService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('exchange');
    }


    public function store(Request $request)
    {
        $amount = floatval(str_replace(['.', ','], ['', '.'], $request->get('amount')));
        $paymentMethod = $request->get('payment_method');
        $targetCurrency = $request->get('target-currency');
        $destinationCurrency = $request->get('destination-currency');

        $exchangeRateData = $this->exchangeService->fetchExchangeValues($destinationCurrency . '-' . $targetCurrency);
        $conversionResult = $this->exchangeService->calculateConversion($amount, $paymentMethod, $exchangeRateData);

        dd($conversionResult);

        return response()->json($conversionResult);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exchange $exchange)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exchange $exchange)
    {
        //
    }
}
