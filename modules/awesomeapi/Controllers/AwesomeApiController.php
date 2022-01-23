<?php

declare(strict_types=1);

namespace AwesomeApi\Controllers;

use App\Http\Controllers\Controller;
use AwesomeApi\Services\AwesomeApiService;

class AwesomeApiController extends Controller
{
    private AwesomeApiService $awesomeApiService;

    public function __construct(AwesomeApiService $awesomeApiService)
    {
        $this->awesomeApiService = $awesomeApiService;
    }

    public function listAvailableCurrencies(): array
    {
        return $this->awesomeApiService->currenciesAvailable();
    }
}
