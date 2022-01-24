<?php

namespace App\Http\Resources;

use App\Support\Money;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class QuoteResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'origin_currency' => 'BRL',
            'destination_currency' => $this->destination_currency,
            'amount' => (new Money($this->amount))->format('BRL'),
            'amount_received' => (new Money($this->amount_received))->format($this->destination_currency),
            'amount_converted' => (new Money($this->amount_converted))->format('BRL'),
            'payment_method' => __($this->payment_method),
            'payment_method_fee' =>   (new Money($this->payment_method_fee))->format('BRL'),
            'conversion_fee' =>   (new Money($this->conversion_fee))->format('BRL'),
        ];
    }
}
