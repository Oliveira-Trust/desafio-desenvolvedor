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
	public function implementaRegras($cotacao) {

        return $cotacao/100 * 7.63;
	}
}
