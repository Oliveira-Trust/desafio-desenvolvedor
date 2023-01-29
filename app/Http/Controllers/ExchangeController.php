<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExchangeRequest;
use App\Services\ExchangeService;
class ExchangeController extends Controller
{
    public function __invoke(ExchangeRequest $request, ExchangeService $service) {
        $method = $request->payment_method;
        $ammount = $request->ammount;
        $currency = $request->currency;
        return $service->create($currency,$method, $ammount);

    }

}
