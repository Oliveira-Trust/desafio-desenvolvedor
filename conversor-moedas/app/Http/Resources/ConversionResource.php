<?php

namespace App\Http\Resources;

use Illuminate\Support\Str;
use Illuminate\Http\Resources\Json\JsonResource;

class ConversionResource extends JsonResource
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
            'coin_price_id' => $this->id,
            'value' => $this->value,
        ];


        collect($this->getRelations())
            ->each(function ($relation, string $relationName) use (&$response) {
                if ($relationName === 'coinPrice') {
                    $response[Str::snake($relationName)] = new CoinPriceResource($this->$relationName);
                    return;
                }

                $response[Str::snake($relationName)] = $this->$relationName;
            });

        return $response;
    }
}
