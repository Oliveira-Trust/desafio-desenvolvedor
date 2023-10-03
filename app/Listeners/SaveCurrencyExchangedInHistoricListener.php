<?php

namespace App\Listeners;

use App\Events\CurrencyExchanged;
use App\Services\CurrencyExchangeHistoricService;

class SaveCurrencyExchangedInHistoricListener
{
    public $connection = 'database';

    public $queue = 'default';

    public $tries = 1;

    public function __construct(private readonly CurrencyExchangeHistoricService $currencyExchangeHistoricService)
    {}

    /**
     * Handle the event.
     */
    public function handle(CurrencyExchanged $event): void
    {
        $this->currencyExchangeHistoricService->saveHistoric($event->currencyQuotation);
    }
}
