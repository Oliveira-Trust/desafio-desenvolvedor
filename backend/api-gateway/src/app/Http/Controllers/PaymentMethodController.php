<?php

namespace App\Http\Controllers;

use App\Services\ApiConsume\Exchange\PaymentMethodApiService;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class PaymentMethodController extends Controller {

    public function __construct(private PaymentMethodApiService $payment_method_api_service) { }

    /**
     * @OA\Get(
     *  path="/api/payment_method",
     *  summary="Retrieve payment methods",
     *  operationId="paymentMethodIndex",
     *  tags={"Payment methods"},
     *  security={ {"bearerAuth": {}} },
     *  @OA\Response( response=200, description="OK", ),
     * )
     */
    public function index() {
        return $this->makeResponse($this->payment_method_api_service->index());
    }

    /**
     * @OA\Get(
     *  path="/api/payment_method/{id}",
     *  summary="Retrieve payment method by id",
     *  operationId="paymentMethodShow",
     *  tags={"Payment methods"},
     *  security={ {"bearerAuth": {}} },
     *  @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="Payment method id",
     *     required=true,
     *  ),
     *  @OA\Response( response=200, description="OK", ),
     * )
     */
    public function show($payment_method_id) {
        return $this->makeResponse($this->payment_method_api_service->show($payment_method_id));
    }

    /**
     * @OA\Put(
     *  path="/api/payment_method/{id}",
     *  summary="Update payment method by id",
     *  operationId="paymentMethodUpdate",
     *  tags={"Payment methods"},
     *  security={ {"bearerAuth": {}} },
     *  @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="Payment method id",
     *     required=true,
     *  ),
     *  @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *        required={"fee_rate"},
     *        @OA\Property(property="fee_rate", type="float", example="1.5"),
     *     ),
     *  ),
     *  @OA\Response( response=200, description="OK", ),
     * )
     */
    public function update(Request $request, $payment_method_id) {
        return $this->makeResponse($this->payment_method_api_service->update($payment_method_id, $request->all()));
    }
}
