<?php

namespace Modules\Exchange\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class ExchangeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->uuid,
            'origin_currency' => $this->resource->origin_currency,
            'destination_currency' => $this->resource->destination_currency->value,
            'conversion_value' => formatCurrency($this->conversion_value),
            'payment_method' => formatPaymentMethod($this->resource->payment_method->value),
            'exchange' => formatCurrency($this->resource->exchange),
            'pay_rate' => $this->resource->pay_rate."%",
            'exchange_rate' => $this->resource->exchange_rate."%",
            'pay_rate_value' => formatCurrency($this->resource->pay_rate_value),
            'exchange_rate_value' => formatCurrency($this->resource->exchange_rate_value),
            'conversion_value_with_fees' => formatCurrency($this->resource->conversion_value_with_fees),
            'purchased_value' => formatCurrency($this->resource->purchased_value, $this->resource->destination_currency->value),
            'created_at' => $this->resource->created_at->format('d/m/Y H:i:s')
        ];
    }
}
