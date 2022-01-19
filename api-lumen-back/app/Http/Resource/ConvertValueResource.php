<?php

namespace App\Http\Resource;

use Illuminate\Http\Resources\Json\JsonResource;

class ConvertValueResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id"                   => $this->id,
            "originValue"          => $this->origin_value,
            "originCurrency"       => $this->origin_currency,
            "convertedValue"       => $this->converted_value,
            "convertedCurrency"    => $this->converted_currency,
            "paymentMethod"        => $this->payment_method,
            "tenantId"             => $this->tenant_id,
            "taxConversion"        => $this->tax_conversion,
            "taxPaymentMethod"     => $this->tax_payment_method,
            "taxCurrency"          => $this->tax_currency,
            "updatedValue"         => $this->updated_value
        ];
    }
}
