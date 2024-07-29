<?php

namespace App\Http\Controllers;

use App\Models\CurrencyHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CurrencyController extends Controller
{
    public function index()
    {
        $histories = CurrencyHistory::where('user_id', Auth::id())->orderBy('created_at', 'desc')->limit(5)->get();
        return view('currency.index', compact('histories'));
    }

    public function convert(Request $request)
    {
        $request->validate([
            'currency' => 'required|string',
            'amount' => 'required|numeric|min:1000|max:100000',
            'payment_method' => 'required|in:boleto,credit_card',
        ]);

        $source_currency = 'BRL';
        $target_currency = $request->input('currency');
        $amount = $request->input('amount');
        $payment_method = $request->input('payment_method');

        // Construir a URL correta
        $url = "https://economia.awesomeapi.com.br/last/{$source_currency}-{$target_currency}";

        // Obter os dados da API
        $response = Http::get($url);

        if ($response->failed()) {
            return redirect()->back()->withErrors(['msg' => 'Não foi possível obter a taxa de câmbio.']);
        }

        $exchange_rate_data = $response->json();
        $exchange_rate = $exchange_rate_data["{$source_currency}{$target_currency}"]['bid'];

        // Calcular taxas
        $payment_fee = $payment_method == 'boleto' ? $amount * 0.0145 : $amount * 0.0763;
        $conversion_fee = $amount < 3000 ? $amount * 0.02 : $amount * 0.01;

        // Calcular o valor convertido
        $amount_after_fees = $amount - $payment_fee - $conversion_fee;
        $converted_amount = $amount_after_fees / $exchange_rate;

        // Salvar histórico
        CurrencyHistory::create([
            'user_id' => Auth::id(),
            'source_currency' => $source_currency,
            'target_currency' => $target_currency,
            'amount' => $amount,
            'payment_method' => $payment_method,
            'exchange_rate' => $exchange_rate,
            'converted_amount' => $converted_amount,
            'payment_fee' => $payment_fee,
            'conversion_fee' => $conversion_fee,
        ]);

        // Redirecionar para a view de resultado
        return view('currency.result', [
            'amount' => $amount,
            'currency' => $target_currency,
            'payment_method' => $payment_method,
            'exchange_rate' => $exchange_rate,
            'converted_amount' => $converted_amount,
            'payment_fee' => $payment_fee,
            'conversion_fee' => $conversion_fee,
            'final_amount' => $amount_after_fees,
        ]);
    }

    public function result()
    {
        return view('currency.result');
    }

    public function history()
    {
        $histories = CurrencyHistory::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('currency.history', compact('histories'));
    }
}
