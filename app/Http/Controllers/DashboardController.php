<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Services\AwesomeApiQuotes\AwesomeApiQuotesService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private AwesomeApiQuotesService $service;
    private Currency $currency;

    public function __construct()
    {
        $this->service = new AwesomeApiQuotesService();
        $this->currency = new Currency();
    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $currencies = $this->currency->get()->pluck('name', 'code');
        $quotes = $this->service->quotes()->last();
        return view('dashboard', compact('quotes', 'currencies'));
    }
}
