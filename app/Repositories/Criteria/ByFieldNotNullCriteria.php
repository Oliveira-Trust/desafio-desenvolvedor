<?php

namespace App\Repositories\Criteria;

use Czim\Repository\Criteria\AbstractCriteria;
use Illuminate\Database\Query\Builder;

/**
 * Class ByFielCriteria
 * @package App\Repositories\Criteria
 */
class ByFieldNotNullCriteria extends AbstractCriteria
{
    /**
     * @var null
     */
    private $field;

    /**
     * @var null
     */
    private $table;

    /**
     * ByFieldEqualCriteria constructor.
     * @param null $field
     * @param null $table
     */
    public function __construct($field, $table = null)
    {
        $this->field = $field;
        $this->table = $table;
    }

    /**
     * @param $model
     * @return mixed
     */
    public function applyToQuery($model)
    {
        if (empty($this->table)) {
            $m = $this->repository->model();
            $this->table = with(new $m)->getTable();
        }

        return $model->whereNotNull($this->table . '.' . $this->field);
    }
}
