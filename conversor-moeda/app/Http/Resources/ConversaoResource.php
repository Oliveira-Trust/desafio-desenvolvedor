<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConversaoResource extends JsonResource
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
            'valor_para_conversao' => $this->valor_para_conversao,
            'forma_pagamento' => $this->forma_pagamento,
            'bid_destino' => $this->bid_destino,
            'valor_comprado' => $this->valor_comprado,
            'taxa_pagamento' => $this->taxa_pagamento,
            'taxa_conversao' => $this->taxa_conversao,
            'valor_utilizado_para_conversao' => $this->valor_utilizado_para_conversao,
        ];
    }
}

