<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class CoinPriceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $response = [
            'id' => $this->id,
            'coin_base_id' => $this->coin_base_id,
            'coin_convert_id' => $this->coin_convert_id,
            'value' => $this->value,
            'reference' => $this->reference
        ];

        collect($this->getRelations())
            ->each(function ($relation, string $relationName) use (&$response) {
                $response[Str::snake($relationName)] = new CoinResource($this->$relationName);
            });
        return $response;
    }
}
