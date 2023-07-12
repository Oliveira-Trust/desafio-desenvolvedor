<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConversionFee\RegisterConversionFeeRequest;
use App\Services\ConversionFee\ConversionFeeServiceContract;
use Symfony\Component\HttpFoundation\Response;


/**
 * @group Conversion Fee
 *
 * API endpoints for Conversion Fee.
 */

class ConversionFeeController extends Controller
{
    protected $conversionFeeService;

    public function __construct(ConversionFeeServiceContract $conversionFeeServiceContract)
    {
        $this->conversionFeeService = $conversionFeeServiceContract;
    }

    /**
     * Register a new conversion fee.
     *
     * Creates a new conversion fee record based on the provided data.
     *
     * @bodyParam reference_value number required The reference value. Example: 1000.00
     * @bodyParam fee_lower_value number required The fee when the value is lower than the reference. Example: 10.00
     * @bodyParam fee_higher_value number required The fee when the value is equal to or higher than the reference. Example: 5.00
     *
     * @response {
     *     "id": 1,
     *     "reference_value": 1000.00,
     *     "fee_lower_value": 10.00,
     *     "fee_higher_value": 5.00,
     *     "created_at": "2023-07-10 12:34:56",
     *     "updated_at": "2023-07-10 12:34:56"
     * }
     *
     * @response 500 {
     *     "message": "Internal server error. Please try again later."
     * }
     *
     */
    public function registerConversionFee(RegisterConversionFeeRequest $request)
    {
        try {
            $data = $request->validated();
            $conversionFee = $this->conversionFeeService->store($data);

            return view('registerconversionfee', ['data' => $conversionFee]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal server error. Please try again later.',
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
