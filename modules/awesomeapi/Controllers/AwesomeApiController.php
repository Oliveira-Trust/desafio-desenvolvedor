<?php

declare(strict_types=1);

namespace AwesomeApi\Controllers;

use App\Http\Controllers\Controller;
use AwesomeApi\Services\AwesomeApiService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AwesomeApiController extends Controller
{
    private AwesomeApiService $awesomeApiService;

    public function __construct(AwesomeApiService $awesomeApiService)
    {
        $this->awesomeApiService = $awesomeApiService;
    }

    public function listAvailableCurrencies(): JsonResponse
    {
        return response()->json(
            $this->awesomeApiService->currenciesAvailable(),
            Response::HTTP_OK);
    }
}
