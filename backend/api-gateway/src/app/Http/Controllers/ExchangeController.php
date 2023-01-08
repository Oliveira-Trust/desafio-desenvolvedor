<?php

namespace App\Http\Controllers;

use App\Services\ApiConsume\Exchange\ExchangeApiService;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class ExchangeController extends Controller {

    public function __construct(private ExchangeApiService $exchange_api_service) { }

    /**
     * @OA\Get(
     *  path="/api/exchange",
     *  summary="Retrieve exchanges created by current authenticated user",
     *  operationId="exchangeIndex",
     *  tags={"Exchanges"},
     *  security={ {"bearerAuth": {}} },
     *  @OA\Response( response=200, description="OK", ),
     * )
     */
    public function indexByUserId(Request $request) {
        return $this->makeResponse($this->exchange_api_service->indexByUserId($request->user()->id));
    }


    /**
     * @OA\Get(
     *  path="/api/exchange/{id}",
     *  summary="Retrieve an exchange by id",
     *  operationId="exchangeShow",
     *  tags={"Exchanges"},
     *  security={ {"bearerAuth": {}} },
     *  @OA\Parameter( name="id", in="path", description="Exchange id", required=true, ),
     *  @OA\Response( response=200, description="OK", ),
     * )
     */
    public function show(Request $request, $exchange_id) {
        return $this->makeResponse($this->exchange_api_service->showByUserId(
            user_id: $exchange_id,
            id: $request->user()->id
        ));
    }


    /**
     * @OA\Post(
     *  path="/api/exchange",
     *  summary="Create a new exchange",
     *  operationId="exchangeCreate",
     *  tags={"Exchanges"},
     *  security={ {"bearerAuth": {}} },
     *  @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *        required={"origin_value","destination_currency_id","payment_method_id"},
     *        @OA\Property(property="origin_value", type="float", example="1000"),
     *        @OA\Property(property="destination_currency_id", type="int", example="2"),
     *        @OA\Property(property="payment_method_id", type="int", example="1"),
     *     ),
     *  ),
     *  @OA\Response( response=201, description="OK", ),
     * )
     */
    public function create(Request $request) {

        return $this->makeResponse($this->exchange_api_service->create(
            data: $request->all(),
            user_id: $request->user()->id,
            email: $request->user()->email,
        ));
    }
}
