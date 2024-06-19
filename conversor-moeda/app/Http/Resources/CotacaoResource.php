<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CotacaoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'moeda_origem' => $this->moeda_origem,
            'moeda_destino' => $this->moeda_destino,
            'cotacao' => $this->cotacao,
            'data' => $this->data,
        ];
    }
}

