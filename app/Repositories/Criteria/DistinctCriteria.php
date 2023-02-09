<?php

namespace App\Repositories\Criteria;

use Czim\Repository\Criteria\AbstractCriteria;

/**
 * Class DistinctCriteria
 * @package App\Repositories\Criteria
 */
class DistinctCriteria extends AbstractCriteria
{
    protected $columns;

    /**
     * @param $columns = null
     */
    public function __construct($columns = null)
    {
        $this->columns = $columns;
    }

    public function applyToQuery($model)
    {
        if (is_null($this->columns)) {
            $baseModel = $this->repository->makeModel();
            $column = "{$baseModel->getTable()}.id";
            return $model->distinct($column);
        }

        return $model->distinct($this->columns);
    }
}
