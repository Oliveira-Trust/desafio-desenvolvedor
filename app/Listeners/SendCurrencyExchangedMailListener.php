<?php

namespace App\Listeners;

use App\Events\CurrencyExchanged;
use App\Services\CurrencyQuotationService;

class SendCurrencyExchangedMailListener
{
    public $connection = 'database';

    public $queue = 'default';

    public $tries = 1;

    public function __construct(private readonly CurrencyQuotationService $currencyQuotationService)
    {
    }

    /**
     * Handle the event.
     */
    public function handle(CurrencyExchanged $event): void
    {
        $this->currencyQuotationService->sendCurrencyExchangeMail($event->currencyQuotation);
    }

    public function retryUntil(): \DateTime
    {
        return now()->addSeconds(5);
    }
}
