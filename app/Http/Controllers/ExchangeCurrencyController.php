<?php

namespace App\Http\Controllers;

use App\Services\ExchangeCurrencyService;
use Illuminate\Http\Request;
use Symfony\Component\Intl\Currencies;

class ExchangeCurrencyController extends Controller
{
    public function index(Request $request)
    {
        return (new ExchangeCurrencyService($request))->response();
    }
}
