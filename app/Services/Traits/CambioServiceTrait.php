<?php

namespace App\Integrations\Traits;

use App\Http\Resources\Traits\PrepareTrait;

trait CambioServiceTrait
{
    use PrepareTrait;

    public function prepareRealizarCompra(array $params)
    {
        if (\count($params))
        {
            $dadosCompra = $params[0];
            return [
                "moeda_origem" => "BRL",
                "moeda_destino" => $dadosCompra["moeda"],
                "valor_solicitado" => $dadosCompra["valorSolicitado"],
                "forma_pagamento" => $dadosCompra["formaPagamento"],
                "cotacao_moeda_destino" => $dadosCompra["valorMoedaDestino"],
                "valor_comprado" => $dadosCompra["valorCompra"],
                "taxa_forma_pagamento" => $dadosCompra["valorTaxaPagamento"],
                "taxa_conversao" => $dadosCompra["valorTaxaConversao"],
                "valor_base_conversao" => $dadosCompra["valorComDescontoAplicado"],
            ];
        }
        return [];
    }
}
