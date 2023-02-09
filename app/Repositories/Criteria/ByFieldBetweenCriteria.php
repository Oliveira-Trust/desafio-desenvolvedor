<?php

namespace App\Repositories\Criteria;

use Czim\Repository\Criteria\AbstractCriteria;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\Expression;

/**
 * Class ByFieldBetweenCriteria
 * @package App\Repositories\Criteria
 */
class ByFieldBetweenCriteria extends AbstractCriteria
{
    /**
     * @var null
     */
    private $field;
    /**
     * @var null
     */
    private $final;
    /**
     * @var null
     */
    private $initial;
    /**
     * @var null
     */
    private $table;

    /**
     * ByFieldEqualCriteria constructor.
     * @param $field
     * @param null $final
     * @param int $initial
     * @param null $table
     */
    public function __construct($field, $final = null, $initial = 0, $table = null)
    {
        $this->field = $field;
        $this->final = $final;
        $this->initial = $initial;
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
        $query = $model->where($field, '<', $this->final);
        return $query;
    }
}
