<?php

namespace App\Domains\MarketData\Presentation\Http\Controllers;

use App\Domains\MarketData\Application\DTOs\MarketDataSearchResponseDTO;
use App\Domains\MarketData\Application\Services\MarketDataService;
use App\Http\Controllers\Controller;
use App\Shared\Responses\ApiSuccess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MarketDataController extends Controller
{
    public function index(Request $request, MarketDataService $marketDataService): JsonResponse
    {
        $validated = $request->validate([
            'TckrSymb' => ['nullable', 'string', 'max:255'],
            'RptDt' => ['nullable', 'date_format:Y-m-d'],
            'page' => ['nullable', 'integer', 'min:1'],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100'],
        ]);

        $ticker = $validated['TckrSymb'] ?? null;
        $reportDate = $validated['RptDt'] ?? null;
        $hasFilters = $ticker !== null || $reportDate !== null;

        if (! $hasFilters && (! isset($validated['page']) || ! isset($validated['per_page']))) {
            return response()->json([
                'message' => 'Os parametros page e per_page sao obrigatorios quando nenhum filtro for informado.',
                'errors' => [
                    'page' => ['O campo page e obrigatorio quando nenhum filtro for informado.'],
                    'per_page' => ['O campo per_page e obrigatorio quando nenhum filtro for informado.'],
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
