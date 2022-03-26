<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class CurrencyPurchaseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = parent::toArray($this);

        $data['created_at'] = $this->created_at->format('d/m/Y H:i');
        $data['updated_at'] = $this->updated_at->format('d/m/Y H:i');

        array_walk($data, function (&$value, $key) {
            if (in_array($key, [
                'origin_currency_value',
                'destination_currency_price',
                'convertion_fee',
                'convertion_fee_value',
                'payment_fee',
                'payment_fee_value',
                'converted_currency_value',
            ])) {
                $value = number_format($value * 1, 2, ',', '');
            }
        });

        return $data;
    }
}
