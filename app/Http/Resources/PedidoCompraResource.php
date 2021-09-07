<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PedidoCompraResource extends JsonResource
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
            'user_id' => $this->user_id,
            'cliente_id' =>$this->cliente_id,
            'valor_total' => $this->valor_total,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'itensPedidosCompra' => $this->itensPedidosCompra,
            'cliente' => new ClienteResource($this->cliente),
            'user' => new UserResource($this->user)
        ];
    }
}
