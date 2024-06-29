<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Ensure this line is present

class CurrencyController extends Controller
{
    public function index()
    {
        $apiUrl = 'https://economia.awesomeapi.com.br/json/last/BRL-USD,BRL-EUR,BRL-ARS,BRL-AUD,BRL-CAD,BRL-CHF,BRL-CLP,BRL-DKK,BRL-HKD,BRL-JPY,BRL-MXN,BRL-SGD,BRL-AED,BRL-BBD,BRL-BHD,BRL-CNY,BRL-CZK,BRL-EGP,BRL-GBP,BRL-HUF,BRL-IDR,BRL-ILS,BRL-INR,BRL-ISK,BRL-JMD,BRL-JOD,BRL-KES,BRL-KRW,BRL-LBP,BRL-LKR,BRL-MAD,BRL-MYR,BRL-NAD,BRL-NOK,BRL-NPR,BRL-NZD,BRL-OMR,BRL-PAB,BRL-PHP,BRL-PKR,BRL-PLN,BRL-QAR,BRL-RON,BRL-RUB';
        $response = Http::get($apiUrl);
        $currencyData = $response->json();


        return view('currency_exchange', ['currencyData' => $currencyData]);
    }

    public function convert($combination)
    {
        // Implement the logic to handle currency conversion
        // For now, just display the selected combination
        return view('currency_conversion', ['combination' => $combination]);
    }
}
