<?php

namespace App\Http\Controllers;

use App\Contracts\PaymentMethodRepositoryInterface;
use App\Http\Requests\UpdatePaymentMethodRequest;

class PaymentMethodController extends Controller {

    public function __construct(private PaymentMethodRepositoryInterface $payment_method_repository) { }

    public function index() {
        return $this->successResponse($this->payment_method_repository->getAll());
    }

    public function show($payment_method_id) {
        return $this->successResponse($this->payment_method_repository->findOrFail($payment_method_id));
    }

    public function update(UpdatePaymentMethodRequest $request, $payment_method_id) {
        $result = $this->payment_method_repository->update($payment_method_id, $request->validated());
        return $this->successResponse($result);
    }
}
