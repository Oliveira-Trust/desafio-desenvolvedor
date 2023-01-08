<?php

namespace App\Http\Controllers;

use App\Services\ApiConsume\Exchange\CurrencyApiService;
use OpenApi\Annotations as OA;

class CurrencyController extends Controller {

    public function __construct(private CurrencyApiService $currency_api_service) { }

    /**
     * @OA\Get(
     *  path="/api/currency",
     *  summary="Retrieve available currencies",
     *  operationId="currencyIndex",
     *  tags={"Currencies"},
     *  security={ {"bearerAuth": {}} },
     *  @OA\Response( response=200, description="OK", ),
     * )
     */
    public function index() {
        return $this->makeResponse($this->currency_api_service->index());
    }
}
