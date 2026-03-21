<?php

namespace App\Domains\MarketData\Presentation\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Shared\Responses\ApiSuccess;
use App\Domains\MarketData\Application\Services\MarketDataService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MarketDataController extends Controller
{
    public function index(Request $request, MarketDataService $marketDataService): JsonResponse
    {
        $marketData = $marketDataService->marketDataList();

        return ApiSuccess::make(
            data: $marketData,
            meta: [
                'total' => count($marketData)
            ],
            status: 200,
        );
    }
}