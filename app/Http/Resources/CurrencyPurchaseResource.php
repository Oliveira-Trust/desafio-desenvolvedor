<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
        if($this->conversionFees->isNotEmpty()){
            $data['conversion_fees'] = $this->conversionFees->map(function($conversionFes) use($request){
               return CurrencyPurchaseConversionFeeResource::make($conversionFes)->toArray($request);
            });
        }

        array_walk($data, function (&$value, $key) {
            if (in_array($key, [
                'origin_currency_value',
                'destination_currency_price',
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
