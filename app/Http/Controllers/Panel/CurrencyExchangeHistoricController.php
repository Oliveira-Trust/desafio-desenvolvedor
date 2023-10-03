<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Services\CurrencyExchangeHistoricService;
use Illuminate\Notifications\Notifiable;

class CurrencyExchangeHistoricController extends Controller
{
    use Notifiable;

    public function __invoke(CurrencyExchangeHistoricService $currencyExchangeHistoricService)
    {
        $currencyExchangeHistoricData = $currencyExchangeHistoricService->getHistoric();

        return view('panel.exchange.historic', compact('currencyExchangeHistoricData'));
    }
}
