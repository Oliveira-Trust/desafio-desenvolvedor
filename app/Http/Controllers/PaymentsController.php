<?php

namespace App\Http\Controllers;

use App\Services\PaymentServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class PaymentsController extends Controller
{
    private PaymentServices $paymentServices;

    public function __construct(PaymentServices $paymentServices)
    {
        $this->paymentServices = $paymentServices;
    }

    public function index(): JsonResponse
    {
        return response()->json(
            $this->paymentServices->getAll(),
            Response::HTTP_OK
        );
    }
}
