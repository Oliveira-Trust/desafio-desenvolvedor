<?php

namespace App\Http\Controllers;

use App\Services\ApiConsume\Exchange\FeeApiService;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class FeeController extends Controller {

    public function __construct(private FeeApiService $fee_api_service) { }

    /**
     * @OA\Get(
     *  path="/api/fee",
     *  summary="Retrieve fees",
     *  operationId="feeIndex",
     *  tags={"Exchange fees"},
     *  security={ {"bearerAuth": {}} },
     *  @OA\Response( response=200, description="OK", ),
     * )
     */
    public function index() {
        return $this->makeResponse($this->fee_api_service->index());
    }

    /**
     * @OA\Get(
     *  path="/api/fee/{id}",
     *  summary="Retrieve fee by id",
     *  operationId="feeShow",
     *  tags={"Exchange fees"},
     *  security={ {"bearerAuth": {}} },
     *  @OA\Parameter( name="id", in="path", description="Fee id", required=true, ),
     *  @OA\Response( response=200, description="OK", ),
     * )
     */
    public function show($fee_id) {
        return $this->makeResponse($this->fee_api_service->show($fee_id));
    }

    /**
     * @OA\Delete(
     *  path="/api/fee/{id}",
     *  summary="Delete fee by id",
     *  operationId="feeDelete",
     *  tags={"Exchange fees"},
     *  security={ {"bearerAuth": {}} },
     *  @OA\Parameter( name="id", in="path", description="Fee id", required=true, ),
     *  @OA\Response( response=204, description="OK", ),
     * )
     */
    public function destroy($fee_id) {
        return $this->makeResponse($this->fee_api_service->destroy($fee_id));
    }

    /**
     * @OA\Put(
     *  path="/api/fee/{id}",
     *  summary="Update fee by id",
     *  operationId="feeUpdate",
     *  tags={"Exchange fees"},
     *  security={ {"bearerAuth": {}} },
     *  @OA\Parameter( name="id", in="path", description="Fee id", required=true, ),
     *  @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *        required={"fee_rate","starting_value"},
     *        @OA\Property(property="starting_value", type="float", example="1000"),
     *        @OA\Property(property="fee_rate", type="float", example="1.5"),
     *     ),
     *  ),
     *  @OA\Response( response=200, description="OK", ),
     * )
     */
    public function update(Request $request, $fee_id) {
        return $this->makeResponse($this->fee_api_service->update($fee_id, $request->all()));
    }


    /**
     * @OA\Post(
     *  path="/api/fee",
     *  summary="Create fee",
     *  operationId="feeCreate",
     *  tags={"Exchange fees"},
     *  security={ {"bearerAuth": {}} },
     *  @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *        required={"fee_rate","starting_value"},
     *        @OA\Property(property="starting_value", type="float", example="1000"),
     *        @OA\Property(property="fee_rate", type="float", example="1.5"),
     *     ),
     *  ),
     *  @OA\Response( response=201, description="OK", ),
     * )
     */
    public function create(Request $request) {
        return $this->makeResponse($this->fee_api_service->create($request->all()));
    }
}
