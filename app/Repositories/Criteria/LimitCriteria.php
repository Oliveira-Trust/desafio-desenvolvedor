<?php

namespace App\Repositories\Criteria;

use Czim\Repository\Criteria\AbstractCriteria;
use Illuminate\Database\Query\Builder;

/**
 * Class LimitCriteria
 * @package App\Repositories\Criteria
 */
class LimitCriteria extends AbstractCriteria
{
    private $value;

    public function __construct($value = null)
    {
        $this->value = $value;
    }

    public function applyToQuery($model)
    {
        if (is_null($this->value))
            $query = $model->limit();
        else
            $query = $model->limit($this->value);

        return $query;
    }
}