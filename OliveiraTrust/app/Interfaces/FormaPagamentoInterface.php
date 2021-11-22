<?php

namespace App\Interfaces;

use App\Models\CotacaoModel;

interface FormaPagamentoInterface {

    public function implementaRegras(CotacaoModel $cotacao);
}
