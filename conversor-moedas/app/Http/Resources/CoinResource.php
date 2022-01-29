<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class CoinResource extends JsonResource
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
            'name' => $this->name
        ];

        collect($this->getRelations())
            ->each(function ($relation, string $relationName) use (&$response) {
                $response[Str::snake($relationName)] = new CoinPriceCollection($this->$relationName);
            });

        return $response;
    }
}
