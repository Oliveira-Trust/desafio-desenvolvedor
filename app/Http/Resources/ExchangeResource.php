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
            "moeda_origem" => $this->currencyFrom->description,
            "moeda_destino" => $this->currencyTo->description,
            "forma_pagamento" => $this->paymentMethod->description,
            "valor_a_converter_bruto" => $this->amount_from,
            "valor_a_converter_liquido" => $this->amount_from_net,
            "taxa_pagamento" => $this->payment_method_fee_amount,
            "taxa_conversao" => $this->exchange_fee_amount,
            "preco_moeda_destino" => $this->bid_amount,
            "valor_convertido" => $this->amount_to_net,
        ];
    }
}
