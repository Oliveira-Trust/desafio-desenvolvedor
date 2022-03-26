<?php

namespace App\View\Composers;

use App\Services\CurrencyService;
use Illuminate\View\View;

class CurrencyComposer
{
    public function __construct(
        private CurrencyService $currencyService)
    {}

    public function compose(View $view)
    {
        $view->with('currencies', $this->currencyService->getCurrencies());
    }
}
