<?php

namespace App\Http\Controllers;

use App\Services\ExchangeAPI;
use App\Services\ExchangeCurrencyService;
use Illuminate\Http\Request;
use Symfony\Component\Intl\Currencies;

class WebExchangeController extends Controller
{
    public function exchange()
    {
        $api = new ExchangeAPI();

        return view('welcome', [
            'currency_types' => json_decode($api->getTypes(), true),
        ]);
    }

    public function exchangePost(Request $request)
    {
        $service = new ExchangeCurrencyService($request);
        $result = $service->response();

        $api = new ExchangeAPI();

        return view('welcome', [
            'currency_types' => json_decode($api->getTypes(), true),
            'result' => $result,
        ]);
    }
}
