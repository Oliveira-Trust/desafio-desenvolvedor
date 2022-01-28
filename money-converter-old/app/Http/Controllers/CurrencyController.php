<?php

namespace App\Http\Controllers;

use App\Services\CurrencyService;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    private CurrencyService $currencyService;

    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    /**
     * @throws \App\Exceptions\HttpException
     */
    public function avaliables(): array
    {
        return $this->currencyService->availables();
    }
}
