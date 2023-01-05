<?php

namespace Modules\Exchange\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Exchange\Http\Requests\CreateRatesRequest;
use Modules\Exchange\Services\RatesService;
use Modules\Exchange\Transformers\RatesResource;

class RatesController extends Controller
{
    public function __construct(protected RatesService $ratesService)
    {
    }

    /** @return JsonResponse  */
    public function index(): JsonResponse
    {
        try {
            $rates = $this->ratesService->list();

            return response()->json(
                $rates ? new RatesResource($rates) : [],
                JsonResponse::HTTP_OK
            );
        } catch (\Throwable $th) {
            return response()->json([], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(CreateRatesRequest $request): JsonResponse
    {
        try {

            return response()->json(
                new RatesResource($this->ratesService->updateOrCrate($request->all())),
                JsonResponse::HTTP_CREATED
            );

        } catch (\Throwable $th) {
            return response()->json([], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
