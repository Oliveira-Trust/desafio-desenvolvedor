<?php

namespace App\Http\Resources;

use App\Enums\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentMethodResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $paymentMethod = PaymentMethod::from($this->id);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'fee_percentage' => $paymentMethod->getFeePercentage()

        ];
    }
}
