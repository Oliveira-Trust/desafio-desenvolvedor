<?php

namespace App\Http\Controllers;

use App\Services\PaymentTypeService;
use Illuminate\Http\Request;

class PaymentTypeController extends Controller
{
    private PaymentTypeService $paymentTypeService;

    public function __construct(PaymentTypeService $paymentTypeService)
    {
        $this->paymentTypeService = $paymentTypeService;
    }

    public function index()
    {
        return $this->paymentTypeService->getAll();
    }

    public function getTaxes(Request $request, int $paymentId)
    {
        return $this->paymentTypeService->getAllTaxes($paymentId);
    }
}
