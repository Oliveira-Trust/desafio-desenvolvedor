<?php

namespace App\Http\Controllers;

use App\Enum\PaymentMethod;
use App\Models\Quote;
use App\Models\TaxSettings;
use App\Services\AwesomeApiService;
use App\Services\QuotationService;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        $sourceCurrencies = [
            'BRL' => 'Real Brasileiro',
            'EUR' => 'Euro',
            'USD' => 'Dólar Americano',
            'BTC' => 'Bitcoin',
        ];
        $targetCurrencies = AwesomeApiService::getCurrencies();


        return inertia('Quote/Create', [
            'sourceCurrencies' => $sourceCurrencies,
            'targetCurrencies' => $targetCurrencies,
            'paymentMethods' => PaymentMethod::cases()
        ]);

    }

    public function quotation(Request $request)
    {
        if(!QuotationService::validateAvailability($request)){
            return response()->json([], 400);
        }
        $quotation = QuotationService::getQuotation($request);

        return response()->json($quotation);
    }

    public function store(Request $request)
    {
        dd(QuotationService::getQuotation($request));
    }

    public function show(Quote $quote)
    {
    }

    public function edit(Quote $quote)
    {
    }

    public function update(Request $request, Quote $quote)
    {
    }

    public function destroy(Quote $quote)
    {
    }
}
