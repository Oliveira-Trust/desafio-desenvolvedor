<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\CurrencyConversionSevice;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ConversionController extends Controller
{

    public function index(): Application|Factory|View
    {

        $service = resolve(CurrencyConversionSevice::class);
        $currencies = $service->listAllCurrencies();

        $data = [
            'currencies' => $currencies
        ];

        return view("currency_conversion.index")->with($data);
    }
}
