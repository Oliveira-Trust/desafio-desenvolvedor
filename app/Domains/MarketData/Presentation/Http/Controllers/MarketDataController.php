<?php

namespace App\Domains\MarketData\Presentation\Http\Controllers;

use App\Domains\MarketData\Application\DTOs\MarketDataSearchResponseDTO;
use App\Domains\MarketData\Application\Services\MarketDataService;
use App\Domains\MarketData\Presentation\Http\Requests\IndexMarketDataRequest;
use App\Http\Controllers\Controller;
use App\Shared\Responses\ApiSuccess;
use Illuminate\Http\JsonResponse;

class MarketDataController extends Controller
{
    public function index(IndexMarketDataRequest $request, MarketDataService $marketDataService): JsonResponse
    {
        $validated = $request->validated();

        $ticker = $validated['TckrSymb'] ?? null;
        $reportDate = $validated['RptDt'] ?? null;
        $requiresPagination = $ticker === null;

        if ($requiresPagination && (! isset($validated['page']) || ! isset($validated['per_page']))) {
            return response()->json([
                'message' => 'Os parametros page e per_page sao obrigatorios quando TckrSymb nao for informado.',
                'errors' => [
                    'page' => ['O campo page e obrigatorio quando TckrSymb nao for informado.'],
                    'per_page' => ['O campo per_page e obrigatorio quando TckrSymb nao for informado.'],
                ],
            ], 422);
        }

        $result = $marketDataService->search(
            ticker: $ticker,
            reportDate: $reportDate,
            perPage: $validated['per_page'] ?? null,
            page: $validated['page'] ?? null
        );

        $items = $this->transformItems($result['data']);

        return ApiSuccess::make(
            data: $items,
            meta: $result['meta'],
            status: 200,
        );
    }

    /**
     * @param  array<int, mixed>  $items
     * @return array<int, array<string, string>>
     */
    private function transformItems(array $items): array
    {
        return array_map(
            static fn($marketData): array => MarketDataSearchResponseDTO::fromModel($marketData)->toArray(),
            $items
        );
    }
}
