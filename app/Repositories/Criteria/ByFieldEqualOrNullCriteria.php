<?php

namespace App\Repositories\Criteria;

use Czim\Repository\Criteria\AbstractCriteria;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\Expression;

/**
 * Class ByFieldEqualOrNullCriteria
 * @package App\Repositories\Criteria
 */
class ByFieldEqualOrNullCriteria extends AbstractCriteria
{
    /**
     * @var null
     */
    private $field;
    /**
     * @var null
     */
    private $value;
    /**
     * @var null
     */
    private $table;

    /**
     * ByFieldEqualOrNullCriteria constructor.
     * @param null $field
     * @param null $value
     * @param null $table
     */
    public function __construct($field = null, $value = null, $table = null)
    {
        $this->field = $field;
        $this->value = $value;
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

        $query = $model->where(function ($query) use ($field){
            $query->where($field, $this->value);
            $query->orWhereNull($field);
        });

        return $query;
    }
}
