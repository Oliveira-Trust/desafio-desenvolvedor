<?php

namespace App\Services;

use App\Mail\BuyCurrency;
use App\Models\ConversionFee;
use App\Models\Currency;
use App\Models\CurrencyPurchase;
use App\Rest\AwesomeApiQuoteCurrency;
use Illuminate\Support\Facades\Mail;

class ConversionFeeService
{

    public function getConversionFees(array $data = [])
    {
        return ConversionFee::query()->search($data)->get();
    }

    public function createConversionFee(array $data)
    {
        return ConversionFee::query()->create($data);
    }

    public function updateConversionFee(array $data, $id)
    {
        return ConversionFee::query()->find($id)->fill($data)->update();
    }
}
