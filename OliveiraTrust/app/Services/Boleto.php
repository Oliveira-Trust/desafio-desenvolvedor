<?php

namespace App\Services;

use App\Interfaces\FormaPagamentoInterface;

class Boleto implements FormaPagamentoInterface{

	/**
	 *
	 * @param mixed $this
	 *
	 * @return mixed
	 */
	public function implementaRegras($cotacao) {

        return $cotacao/100 * 1.75;
	}
}
