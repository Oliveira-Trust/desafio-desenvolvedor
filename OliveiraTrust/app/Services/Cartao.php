<?php

namespace App\Services;

use App\Interfaces\FormaPagamentoInterface;
use App\Models\CotacaoModel;

class Cartao implements FormaPagamentoInterface{

	/**
	 *
	 * @param mixed $this
	 *
	 * @return mixed
	 */
	function implementaRegras(CotacaoModel $cotacao) {

        return $cotacao->valor_liquido * 7.63;
	}
}
