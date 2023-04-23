<?php

namespace App\Services;

use App\Models\CurrencyExchange;
use Exception;
use Illuminate\Support\Facades\Auth;

class CurrencyExchangeService
{
    public static function getUserHistory()
    {
        $user = Auth::user();
        return CurrencyExchange::with('payment_method')->where('user_id', $user->id)->get();
    }

    public static function storeExchangeCalc(array $data)
    {
        $user = Auth::user();
        CurrencyExchange::create([
            'user_id' => $user->id,
            'from_currency' => $data['from_currency'],
            'to_currency' => $data['to_currency'],
            'currency_value' => $data['currency_value'],
            'payment_method_id' => $data['payment_method_id'],
            'payment_method_rate' => $data['payment_method_rate'],
            'payment_method_tax' => $data['payment_method_tax'],
            'amount' => $data['amount'],
            'amount_tax' => $data['amount_tax'],
            'amount_after_taxes' => $data['amount_after_taxes'],
            'net_total' => $data['net_total'],
        ]);
    }

    public static function deleteUserHistory()
    {
        $user = Auth::user();
        CurrencyExchange::where('user_id', $user->id)->delete();
    }
}
