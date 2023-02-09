<?php

namespace App\Repositories\Criteria;

use Czim\Repository\Criteria\AbstractCriteria;

/**
 * Class DistinctCriteria
 * @package App\Repositories\Criteria
 */
class OnlyTrashedCriteria extends AbstractCriteria
{
    public function applyToQuery($model)
    {
        return $model->onlyTrashed();
    }
}
