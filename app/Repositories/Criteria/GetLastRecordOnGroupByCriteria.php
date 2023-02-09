<?php

namespace App\Repositories\Criteria;

use Czim\Repository\Criteria\AbstractCriteria;
use Illuminate\Database\Query\Expression;

/**
 * Class WhereInCriteria
 * @package App\Repositories\Criteria
 */
class GetLastRecordOnGroupByCriteria extends AbstractCriteria
{
    private $field;
    private $groupByField;
    /**
     * @var null
     */
    private $table;

    /**
     * WhereInCriteria constructor.
     * @param $field
     * @param $groupByField
     * @param null $table
     */
    public function __construct($field, $groupByField = null, $table = null)
    {
        $this->field = $field;
        $this->groupByField = $groupByField;
        $this->table = $table;
    }

    public function applyToQuery($model)
    {
        if (empty($this->table)) {
            $m = $this->repository->model();
            $this->table = with(new $m)->getTable();
        }

        $field = $this->field instanceof Expression ? $this->field : "{$this->table}.{$this->field}";

        $query = $model->whereIn($field, function ($query) {
            $query->selectRaw("MAX($this->field)")->from($this->table)->groupBy($this->groupByField);
        });

        return $query;
    }
}