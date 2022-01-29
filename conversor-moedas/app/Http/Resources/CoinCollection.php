<?php

namespace App\Http\Resources;

use App\Models\Coin;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CoinCollection extends ResourceCollection
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
            'data' => $this->collection->map(function (Coin $coin) {
                return [
                    'id' => $coin->id,
                    'name' => $coin->name,
                ];
            }),
            'cacheable' => true
        ]);

        return $response;
    }
}
