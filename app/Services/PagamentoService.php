<?php

namespace App\Services;

use App\Models\Pagamento;

class PagamentoService
{
    public function getInfo($pagamentoId)
    {
        return Pagamento::find($pagamentoId);
    }
}
