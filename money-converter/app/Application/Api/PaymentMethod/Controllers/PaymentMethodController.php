<?php

namespace App\Api\PaymentMethod\Controllers;

use App\Core\Http\Controllers\Controller;
use Domain\PaymentMethod\Repositories\PaymentMethodRepository;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    private PaymentMethodRepository $paymentMethodRepository;

    public function __construct(PaymentMethodRepository $paymentMethodRepository)
    {
        $this->paymentMethodRepository = $paymentMethodRepository;
    }

    public function index(): \Illuminate\Http\JsonResponse
    {
        $allPaymentMethods = $this->paymentMethodRepository->findAll();
        return response()->json($allPaymentMethods);
    }

    public function show(Request $request, int $paymentMethodId)
    {
        $findPaymentMethod = $this->paymentMethodRepository->findById($paymentMethodId);
        return response()->json($findPaymentMethod);
    }

    public function getFees(Request $request, int $paymentMethodId): \Illuminate\Http\JsonResponse
    {
        $findFees = $this->paymentMethodRepository->findById($paymentMethodId)->fees;
        return response()->json($findFees);
    }
}
