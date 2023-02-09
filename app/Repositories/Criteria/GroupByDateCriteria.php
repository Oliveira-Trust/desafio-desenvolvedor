<?php

namespace App\Repositories\Criteria;

use Czim\Repository\Criteria\AbstractCriteria;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

/**
 * Class GroupByCriteria
 * @package App\Repositories\Criteria
 */
class GroupByDateCriteria extends AbstractCriteria
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
     * @var null
     */
    private $dateFormat;

    /**
     * GroupByCriteria constructor.
     * @param $field
     * @param null $table
     * @param null $dateFormat
     */
    public function __construct($field, $table = null, $dateFormat = 'Y-m-d')
    {
        $this->field = $field;
        $this->table = $table;
        $this->dateFormat = $dateFormat;
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

        if (empty($this->dateFormat)) {
            $query = $model->groupBy("{$table}.{$this->field}");
        } else {
            $query = $model
                ->addSelect(DB::raw("COUNT({$table}.id) as total"))
                ->groupBy(DB::raw("DATE_FORMAT({$table}.{$this->field}, '%Y-%m-%d')"));
        }
        return $query;
    }
}
