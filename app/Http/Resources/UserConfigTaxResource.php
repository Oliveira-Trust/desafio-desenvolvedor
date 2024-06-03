<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserConfigTaxResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'payment_method' => $this->payment_method,
            'payment_method_fee' => $this->payment_method_fee,
            'conversion_fee_above_threshold' => $this->conversion_fee_above_threshold,
            'conversion_fee_below_threshold' => $this->conversion_fee_below_threshold,
            'conversion_fee_threshold' => $this->conversion_fee_threshold,
        ];
    }
}
