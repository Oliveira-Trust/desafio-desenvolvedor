<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConversionResource extends JsonResource
{
    /**
     * Transforme o recurso em uma array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        if (isset($this->resource['error'])) {
            return ['erro' => $this->resource['error']];
        }

        return [
            'origin_currency' => $this->resource['origin_currency'],
            'destination_currency' => $this->resource['destination_currency'],
            'value_conversation' => $this->resource['value_conversation'],
            'form_payment' => $this->resource['form_payment'],
            'dest_currency_conv' => $this->resource['dest_currency_conv'],
            'purchased_amount_in' => $this->resource['purchased_amount_in'],
            'pay_rate' => $this->resource['pay_rate'],
            'conversion_rate' => $this->resource['conversion_rate'],
            'amount_used_conv' => $this->resource['amount_used_conv'],

        ];
    }
}
