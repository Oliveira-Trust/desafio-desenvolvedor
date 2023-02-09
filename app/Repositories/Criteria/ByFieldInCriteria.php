<?php

namespace App\Repositories\Criteria;

use Czim\Repository\Criteria\AbstractCriteria;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\Expression;

/**
 * Class ByFieldInCriteria
 * @package App\Repositories\Criteria
 */
class ByFieldInCriteria extends AbstractCriteria
{
    /**
     * @var null
     */
    private $field;
    /**
     * @var null
     */
    private $values;
    /**
     * @var null
     */
    private $table;

    /**
     * ByFieldInCriteria constructor.
     * @param null $field
     * @param null $values
     * @param null $table
     */
    public function __construct($field = null, $values = null, $table = null)
    {
        $this->field = $field;
        $this->values = $values;
        $this->table = $table;
    }

    /**
     * @param $model
     * @return mixed
     */
    public function applyToQuery($model)
    {
        if (empty($this->table)) {;
            $m = $this->repository->model();
            $this->table = with(new $m)->getTable();
        }

        $field = $this->field instanceof Expression ? $this->field : "{$this->table}.{$this->field}";

        $query = $model->whereIn($field, $this->values);
        
        return $query;
    }
}
