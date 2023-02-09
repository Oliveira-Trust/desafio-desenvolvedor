<?php

namespace App\Repositories\Criteria;

use Czim\Repository\Criteria\AbstractCriteria;
use DB;

/**
 * Class ForceEmptyResultCriteria
 * @package App\Repositories\Criteria
 */
class ForceEmptyResultCriteria extends AbstractCriteria
{
    public function applyToQuery($model)
    {
        return $model->whereRaw(DB::raw('false'));
    }
}
