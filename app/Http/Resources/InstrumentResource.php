<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InstrumentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'ticker'     => $this->ticker,
            'nome'       => $this->name,
            'segmento'   => $this->segment,
            'moeda'      => $this->currency,
            'atualizado' => $this->updated_at->format('d/m/Y H:i:s'),
        ];
    }
}
