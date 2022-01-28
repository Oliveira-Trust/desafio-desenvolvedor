<?php

namespace App\Http\Resources;

use App\Models\PaymentMethod;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PaymentMethodCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $response = collect([
            'data' => $this->collection->map(function (PaymentMethod $paymentMethod) {
                return [
                    'id' => $paymentMethod->id,
                    'name' => $paymentMethod->name,
                    'tax' => $paymentMethod->tax
                ];
            }),
            'cacheable' => true
        ]);

        return $response;
    }
}
