<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\QuotationService;
use stdClass;

class QuotationController extends Controller
{
    //
    public function __construct(QuotationService $quotationService) {
        $this->serviceInstance   = $quotationService;
    }

    protected $exchangeRules = [
        'finalCoin'         => 'required|string|min:3|max:3',
        'conversionValue'   => 'required|numeric|min:1000|max:100000',
        'paymentType'       => 'required|string',
    ];

    public function quotation(Request $request) {

        $validator = Validator::make($request->all(), $this->exchangeRules);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'data' => $validator->errors()
            ], 422);
        }

        $instance = $this->serviceInstance->quotation($request->all());


        return response()->json([
            'error'     => false,
            'data'      => $instance
        ], 200);
    }

    public function getAllCoin() {
        $instance = $this->serviceInstance->getAllCoin();

        return response()->json([
            'error'     => false,
            'data'      => $instance
        ], 200);
    }

    public function getPaymentType() {
        $instance = $this->serviceInstance->getPaymentType();

        return response()->json([
            'error'     => false,
            'data'      => $instance
        ], 200);
    }
}
