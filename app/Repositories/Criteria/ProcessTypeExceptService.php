<?php

namespace App\Repositories\Criteria;

use Czim\Repository\Criteria\AbstractCriteria;
use Illuminate\Database\Query\Builder;

/**
 * Class ByFieldEqualCriteria
 * @package App\Repositories\Criteria
 */
class ProcessTypeExceptService extends AbstractCriteria
{
    /**
     * @param $model
     * @return mixed
     */
    public function applyToQuery($model)
    {
        return $model->where('is_service', false);
    }
}
