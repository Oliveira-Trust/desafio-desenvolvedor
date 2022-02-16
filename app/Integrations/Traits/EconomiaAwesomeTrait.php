<?php

namespace App\Integrations\Traits;

use App\Http\Resources\Traits\PrepareTrait;

trait EconomiaAwesomeTrait
{
    use PrepareTrait;

    public function prepareAll(array $params)
    {
        return \count($params) ? (array) $params[0] : [];
    }

    public function prepareCombinacoes(array $params)
    {
        return \count($params) ? (array) $params[0] : [];
    }

    public function prepareCotacaoMoeda(array $params)
    {
        return \count($params) ? (array) $params[0] : [];
    }
}
