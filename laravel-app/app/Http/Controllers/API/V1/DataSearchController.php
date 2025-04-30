<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchDataRequest;
use App\Http\Resources\DataResource;
use App\Repositories\MongoDbDataRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

/**
 * @OA\Tag(
 *     name="Data",
 *     description="API endpoints for financial data search"
 * )
 */
class DataSearchController extends Controller
{
    /**
     * The data repository instance.
     *
     * @var MongoDbDataRepository
     */
    protected $repository;

    /**
     * Create a new controller instance.
     *
     * @param MongoDbDataRepository $repository
     */
    public function __construct(MongoDbDataRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Search for financial data with optional filtering.
     * 
     * @OA\Get(
     *     path="/api/v1/data",
     *     summary="Search financial data",
     *     description="Retrieves financial data with optional filtering by ticker symbol and date",
     *     operationId="searchData",
     *     tags={"Data"},
     *     security={ {"sanctum": {} }},
     *     @OA\Parameter(
     *         name="TckrSymb",
     *         in="query",
     *         description="Ticker symbol to filter by",
     *         required=false,
     *         @OA\Schema(type="string", example="AAPL")
     *     ),
     *     @OA\Parameter(
     *         name="RptDt",
     *         in="query",
     *         description="Report date to filter by (YYYY-MM-DD)",
     *         required=false,
     *         @OA\Schema(type="string", format="date", example="2023-01-01")
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number for pagination",
     *         required=false,
     *         @OA\Schema(type="integer", default=1, minimum=1)
     *     ),
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Number of items per page",
     *         required=false,
     *         @OA\Schema(type="integer", default=50, minimum=1, maximum=100)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="RptDt", type="string", format="date", example="2023-01-01"),
     *                     @OA\Property(property="TckrSymb", type="string", example="AAPL"),
     *                     @OA\Property(property="MktNm", type="string", example="NASDAQ"),
     *                     @OA\Property(property="SctyCtgyNm", type="string", example="Equity"),
     *                     @OA\Property(property="ISIN", type="string", example="US0378331005"),
     *                     @OA\Property(property="CrpnNm", type="string", example="Apple Inc.")
     *                 )
     *             ),
     *             @OA\Property(property="meta", type="object",
     *                 @OA\Property(property="current_page", type="integer", example=1),
     *                 @OA\Property(property="per_page", type="integer", example=50),
     *                 @OA\Property(property="total", type="integer", example=100),
     *                 @OA\Property(property="last_page", type="integer", example=2)
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="errors", type="object")
     *         )
     *     )
     * )
     *
     * @param SearchDataRequest $request
     * @return JsonResponse
     */
    public function search(SearchDataRequest $request): JsonResponse
    {
        $ticker = $request->input('TckrSymb');
        $date = $request->input('RptDt');
        $perPage = $request->input('per_page', 50);
        $page = $request->input('page', 1);
        
        $offset = ($page - 1) * $perPage;
        
        $cacheKey = "data_search_" . md5("{$ticker}_{$date}_{$perPage}_{$offset}");
        
        $result = Cache::remember($cacheKey, 60 * 30, function () use ($ticker, $date, $perPage, $offset) {
            return $this->repository->search($ticker, $date, $perPage, $offset);
        });
        
        return response()->json([
            'data' => DataResource::collection($result['data']),
            'meta' => [
                'current_page' => $result['page'],
                'per_page' => $result['limit'],
                'total' => $result['total'],
                'last_page' => ceil($result['total'] / $result['limit']),
            ],
        ]);
    }
} 