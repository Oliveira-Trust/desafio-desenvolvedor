<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function getData()
    {
        $response = Http::get('https://economia.awesomeapi.com.br/json/last/BRL-USD');

        if ($response->successful()) {
            $data = $response->json();
            // Return the data or pass it to a view
            return view('data', compact('data'));
        } else {
            // Handle the error
            return response()->json(['error' => 'Unable to fetch data'], $response->status());
        }
    }

    public function exchangeCurrency(Request $request)
    {
        try {
            $amount = $request->input('amount');
            $exchangeRate = $request->input('exchangeRate');

            $convertedAmount = $amount * $exchangeRate;

            return "Converted amount: {$amount} BRL = {$convertedAmount} USD";
        } catch (\Exception $e) {
            // Handle exceptions as needed
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
