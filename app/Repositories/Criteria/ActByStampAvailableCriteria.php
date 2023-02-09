<?php

namespace App\Repositories\Criteria;

use Czim\Repository\Criteria\AbstractCriteria;

/**
 * Class ActByStampAvailableCriteria
 * @package App\Repositories\Criteria
 */
class ActByStampAvailableCriteria extends AbstractCriteria
{
    /**
     * @param $model
     * @return mixed
     */
    public function applyToQuery($model)
    {
        return $model->leftJoin('stamps', function ($join) {
            $join->on('acts.act_code', '=', 'stamps.act_code');
            $join->where('acts.state_id', '=', 'stamps.state_id');
        });
    }
}
