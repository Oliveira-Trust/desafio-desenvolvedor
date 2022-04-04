<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConversionFeeRequest;
use App\Services\ConversionFeeService;

class ConversionFeeController extends Controller
{
    public function __construct(
        private ConversionFeeService $conversionFeeService)
    {}

    public function index()
    {
        return view('conversion_fees');
    }

    public function getConversionFees()
    {
        return response()->json($this->conversionFeeService->getConversionFees());
    }

    public function createConversionFee(ConversionFeeRequest $request)
    {
        return $this->conversionFeeService->createConversionFee($request->all());
    }

    public function updateConversionFee(ConversionFeeRequest $request, $id)
    {
        return $this->conversionFeeService->updateConversionFee($request->all(), $id);
    }
}
