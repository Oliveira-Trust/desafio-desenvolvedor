<?php

declare(strict_types=1);

namespace AwesomeApi\Controllers;

use App\Http\Controllers\Controller;
use AwesomeApi\Services\AwesomeApiService;
use Illuminate\Http\Client\Response;

class AwesomeApiController extends Controller
{
    private AwesomeApiService $awesomeApiService;

    public function __construct(AwesomeApiService $awesomeApiService)
    {
        $this->awesomeApiService = $awesomeApiService;
    }

    public function listAvailableCurrencies(): Response
    {
        return $this->awesomeApiService->currenciesAvailable();
    }
}
