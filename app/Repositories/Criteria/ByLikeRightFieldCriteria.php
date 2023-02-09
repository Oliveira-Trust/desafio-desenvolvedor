<?php

namespace App\Repositories\Criteria;

use Czim\Repository\Criteria\AbstractCriteria;
use Illuminate\Database\Query\Builder;

/**
 * Class ByLikeFieldCriteria
 * @package App\Repositories\Criteria
 */
class ByLikeRightFieldCriteria extends AbstractCriteria
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
     * ByLikeFieldCriteria constructor.
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
        if (empty($this->table)) {
            $m = $this->repository->model();
            $table = with(new $m)->getTable();
        } else {
            $table = $this->table;
        }

        $query = $model->whereRaw(
            "LOWER(`${table}`.`$this->field`) LIKE ?",
            [strtolower($this->value) . '%']
        );

        return $query;
    }
}
