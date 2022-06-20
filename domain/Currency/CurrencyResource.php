<?php

namespace Oliveiratrust\Currency;

use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyResource extends JsonResource {

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $last_price = $this->prices()->latest()->first();

        return [
            'id'         => $this->id,
            'code'       => $this->code,
            'name'       => $this->name,
            'last_price' => number_format($last_price->price, 4, ',', '.'),

            'created_at' => toDate($last_price->created_at, true, 'd/m/Y', 'H:i')
        ];
    }
}
