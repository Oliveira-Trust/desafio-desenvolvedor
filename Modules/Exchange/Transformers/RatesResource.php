<?php

namespace Modules\Exchange\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class RatesResource extends JsonResource
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
            'id' => $this->resource->id,
            'bank_slips' => $this->resource->bank_slips,
            'credit_card' => $this->resource->credit_card,
            'purchase_price_above' => $this->resource->purchase_price_above,
            'purchase_price_below' => $this->resource->purchase_price_below,
            'purchase_price' => $this->resource->purchase_price,
        ];
    }
}
