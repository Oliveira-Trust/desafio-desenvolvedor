<?php

namespace App\Http\Resources;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExchangeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        if (!isset($this->id)) {
            return [];
        }

        return [
            'id' => $this->id,
            'origin_currency' => $this->origin_currency,
            'end_currency' => $this->end_currency,
            'amount' => 'R$ ' . $this->formatDisplayAmount($this->amount),
            'payment_method' => PaymentMethod::select('id','name')->find($this->payment_method_id),
            'end_currency_amount' => $this->end_currency . ' ' .  $this->formatDisplayAmount($this->end_currency_amount),
            'payment_fee' => 'R$ ' .  $this->formatDisplayAmount($this->payment_fee),
            'conversion_fee' => 'R$ ' . $this->formatDisplayAmount($this->conversion_fee),
            'amount_converted' => 'R$ ' . $this->formatDisplayAmount($this->amount_converted)
        ];
    }

    private function formatDisplayAmount(string $amount)
    {
        return number_format($amount, 2, ',', '.');
    }
}
