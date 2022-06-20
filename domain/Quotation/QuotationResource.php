<?php

namespace Oliveiratrust\Quotation;

use Illuminate\Http\Resources\Json\JsonResource;

class QuotationResource extends JsonResource {

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'      => $this->id,
            'user_id' => $this->user_id,

            'payment_type_id'          => $this->payment_type_id,
            'payment_type_description' => $this->paymentType->description,

            'currency_id'   => $this->currency_id,
            'currency_code' => $this->currency->code,
            'currency_name' => $this->currency->name,

            'amount'           => (float)$this->amount,
            'price'            => (float)$this->price,
            'fees'             => $this->fees,
            'exchanged_amount' => (float)$this->exchanged_amount,

            'created_at' => toDate($this->created_at, true, 'd/m/Y', 'H:i')
        ];
    }
}
