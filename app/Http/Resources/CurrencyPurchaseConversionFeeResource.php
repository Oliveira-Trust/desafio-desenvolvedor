<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyPurchaseConversionFeeResource extends JsonResource
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

        array_walk($data, function (&$value, $key) {
            if (in_array($key, [
                'convertion_fee',
                'convertion_fee_value',
            ])) {
                $value = number_format($value * 1, 2, ',', '');
            }
        });

        return $data;
    }
}
