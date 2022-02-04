<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PeopleResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'brithday_age' => $this->brithday_age,
            'weight' => $this->weight,
            'height' => $this->height,
            'career' => $this->career,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
