<?php

namespace App\Services;

use App\Models\PaymentType;

class PaymentTypeService
{
    public function getAll()
    {
        $allPayments = PaymentType::all();
        return response()->json($allPayments);
    }

    public function getAllTaxes(int $paymentId)
    {
        $allTaxes = PaymentType::find($paymentId)->taxe;
        return response()->json($allTaxes);
    }

    public function findByName(string $name)
    {
        return PaymentType::where('name', $name)->first();
    }
}
