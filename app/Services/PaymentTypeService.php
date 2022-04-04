<?php

namespace App\Services;

use App\Mail\BuyCurrency;
use App\Models\Currency;
use App\Models\CurrencyPurchase;
use App\Models\PaymentType;
use App\Rest\AwesomeApiQuoteCurrency;
use Illuminate\Support\Facades\Mail;

class PaymentTypeService
{
    public function getPaymentTypes(array $data = [])
    {
        return PaymentType::query()->search($data)->get();
    }

    public function updatePaymentTypes(array $data, $id)
    {
        return PaymentType::query()->find($id)->fill($data)->update();
    }
}
