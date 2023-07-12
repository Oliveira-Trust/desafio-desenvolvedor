<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentFee\RegisterPaymentFeeRequest;
use App\Services\PaymentFee\PaymentFeeServiceContract;
use Symfony\Component\HttpFoundation\Response;


/**
 * @group Payment Fee
 *
 * API endpoints for Payment Fee.
 */

class PaymentFeeController extends Controller
{
    protected $paymentFeeService;

    public function __construct(PaymentFeeServiceContract $paymentFeeServiceContract)
    {
        $this->paymentFeeService = $paymentFeeServiceContract;
    }

    /**
     * Register a new payment fee.
     *
     * Creates a new payment fee record based on the provided data.
     *
     * @bodyParam type integer required The payment type. Example: 1
     * @bodyParam fee number required The payment fee. Example: 5.00
     *
     * @response {
     *     "id": 1,
     *     "type": 1,
     *     "fee": 5.00,
     *     "created_at": "2023-07-10 12:34:56",
     *     "updated_at": "2023-07-10 12:34:56"
     * }
     *
     * @response 500 {
     *     "message": "Internal server error. Please try again later."
     * }
     *
     */

    public function registerPaymentFee(RegisterPaymentFeeRequest $request)
    {
        try {
            $data = $request->validated();
            $paymentFee = $this->paymentFeeService->store($data);

            return view('registerpaymentfee', ['data' => $paymentFee]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal server error. Please try again later.',
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
