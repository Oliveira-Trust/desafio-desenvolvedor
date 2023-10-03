<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\CurrencyExchangeRequest;
use App\Services\CurrencyQuotationService;

class CurrencyExchangeController extends Controller
{
    public function __construct(private readonly CurrencyQuotationService $currencyQuotationService)
    {}

    public function index(CurrencyExchangeRequest $request)
    {
        $availableCurrencies = $this->currencyQuotationService->getAvailableCurrencies();

        return view('panel.exchange.index', compact('availableCurrencies'));
    }

    public function currencyExchange(CurrencyExchangeRequest $request)
    {
        $currencyQuotation = $this->currencyQuotationService->quoteCurrencies($request->validated());

        session()->flash('currencyQuotation', $currencyQuotation);

        return redirect()->route('index');
    }
}
