<?php

namespace App\Repositories\Criteria;

use Czim\Repository\Criteria\AbstractCriteria;
use Illuminate\Database\Query\Builder;

/**
 * Class GroupByCriteria
 * @package App\Repositories\Criteria
 */
class GroupByCriteria extends AbstractCriteria
{
    /**
     * @var
     */
    private $field;
    /**
     * @var null
     */
    private $table;

    /**
     * GroupByCriteria constructor.
     * @param $field
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
        if(empty($this->table)){
            $m = $this->repository->model();
            $table = with(new $m)->getTable();
        }else{
            $table = $this->table;
        }
        $query = $model->groupBy("{$table}.{$this->field}");

        return $query;
    }
}
