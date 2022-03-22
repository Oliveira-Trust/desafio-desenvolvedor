<?php

namespace App\Http\Controllers;

use App\Services\CurrencyService;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function index(CurrencyService $currencyService)
    {
        return view(
            'purchases.index',
            [
                'purchases' => $currencyService
                    ->getAllPurchasesByUser(Auth::user())
            ]
        );
    }
}