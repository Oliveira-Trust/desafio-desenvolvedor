<?php

namespace App\Repositories\Criteria;

use Czim\Repository\Criteria\AbstractCriteria;

/**
 * Class MultipleAndWhereCriteria
 * @package App\Repositories\Criteria
 */
class MultipleAndWhereCriteria extends AbstractCriteria
{
    /**
     * @var null
     */
    protected $filters;

    /**
     * @var null
     */
    protected $table;

    /**
     * MultipleAndWhereCriteria constructor.
     * @param null $filters
     */
    public function __construct($filters, $table = null)
    {
        $this->filters = $filters;
        $this->table = $table;
    }

    /**
     * @param $model
     * @return mixed
     */
    public function applyToQuery($model)
    {
        if (!$this->table) {
            $m = $this->repository->model();
            $this->table = with(new $m)->getTable();
        }

        foreach ($this->filters as $key => $val) {
            $model = $this->processWhereClauses($model, $key, $val);
        }

        return $model;
    }

    protected function processWhereClauses($builder, $key, $val)
    {
        if (is_array($val)) {
            if (!isset($val[0])) {
                return $builder->where(function ($queryBuilder) use ($val) {
                    foreach ($val as $innerKey => $filter) {
                        $this->processWhereClauses($queryBuilder, $innerKey, $filter);
                    }
                });
            }

            return $builder->where($val[0], $val[1], $val[2]);
        }

        return $builder->where($key, $val);
    }
}
