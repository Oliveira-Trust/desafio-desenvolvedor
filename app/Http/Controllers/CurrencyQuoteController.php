<?php

namespace App\Http\Controllers;

use App\Models\CurrencyQuote;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CurrencyQuoteController extends Controller
{
    public function index()
    {        
        return view('pages.currency-quotes', ['currencyQuotes' => $this->myQuotes()]);
    }


    public function myQuotes()
    {
        $currencyQuotes = CurrencyQuote::where('user_id', Auth::user()->id)->orderByDesc('id')->take(10)->get();

        $quotes = collect($currencyQuotes)->map(function($item) {

            return collect($item)->merge([
                'amount' =>  pv($item['amount']),
                'tax' => pv($item['tax']),
                'currency_code' => $item['currency_code'],
                'final_amount' => currencyFormat($item['currency_code'], $item['final_amount']),
                'payment_method' => $item['payment_method'] == 'boleto' ? 'Boleto' : 'Cartão',
                'created_at' => Carbon::parse($item['created_at'])->format('d/m/Y'),
            ])->only('amount','tax','currency_code','final_amount','payment_method','created_at');

        });

        return $quotes;
    }


    public function store(Request $request)
    {
        $currencyQuote = new CurrencyQuote();
        $currencyQuote->user_id = Auth::user()->id;
        $currencyQuote->amount = $request->amount_row;
        $currencyQuote->tax = $request->tax;
        $currencyQuote->currency_code = $request->currency_code;
        $currencyQuote->final_amount = $request->final_amount;
        $currencyQuote->payment_method = $request->payment_method;
        $currencyQuote->save();
        
        return response()->json('sucesso');
    }
}
