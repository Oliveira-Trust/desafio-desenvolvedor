<?php

namespace App\Http\Resources;

use App\Models\Conversion;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ConversionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection
            ->map(fn (Conversion &$conversion) => new ConversionResource($conversion));
    }
}
