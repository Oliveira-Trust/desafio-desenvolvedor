<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExchangeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'currency' => $this->currency,
            'method' => $this->method,
            'ammount' => $this->ammount,
            'ammount_fee' => $this->ammount_fee,
            'method_fee' => $this->method_fee,
            'net_ammount' => $this->net_ammount,
            'exchange_rate' => $this->exchange_rate,
            'converted_ammount' => $this->converted_ammount,
            'created_at' => $this->created_at,
            'user' => $this->user->email
        ];
    }
}
