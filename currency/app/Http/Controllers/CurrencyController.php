<?php

namespace App\Http\Controllers;

use App\Repositories\CurrencyRepository;
use Illuminate\Http\Request;

use AshAllenDesign\LaravelExchangeRates\ExchangeRate;

use Guzzle\Http\Exception\ClientErrorResponseException;

use carbon\Carbon;

class CurrencyController extends Controller
{
    //

    public function index() {

        return view('index');
    }

    public function convert(Request $request) {

        $data = CurrencyRepository::getInstance()->convert($request);

        return response()->json($data);
    }

}
