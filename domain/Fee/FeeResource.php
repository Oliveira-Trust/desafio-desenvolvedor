<?php

namespace Oliveiratrust\Fee;

use Illuminate\Http\Resources\Json\JsonResource;

class FeeResource extends JsonResource {

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'                   => $this->id,
            'fee_type_id'          => $this->fee_type_id,
            'fee_type_description' => $this->feeType->description,

            'payment_type_id'          => $this->payment_type_id,
            'payment_type_description' => $this->paymentType?->description,

            'min_amount'  => (float)$this->min_amount,
            'max_amount'  => (float)$this->max_amount,
            'percent'     => (float)$this->percent,
            'fixed_value' => (float)$this->fixed_value,

            'updated_at' => toDate($this->updated_at, true, 'd/m/Y', 'H:i')
        ];
    }
}
