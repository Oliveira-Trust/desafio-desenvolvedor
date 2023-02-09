<?php

namespace App\Repositories\Criteria;

use Carbon\Carbon;
use Czim\Repository\Criteria\AbstractCriteria;
use Illuminate\Database\Query\Expression;

/**
 * Class ByMonthYearCriteria
 * @package App\Repositories\Criteria
 */
class ByMonthYearCriteria extends AbstractCriteria
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
     * @var bool
     */
    private $operator;

    /**
     * ByDateCriteria constructor.
     * @param null $field
     * @param Carbon|null $value
     * @param string $operator
     * @param null $table
     */
    public function __construct($field = null, Carbon $value = null, $operator = '=', $table = null)
    {
        $this->field = $field;
        $this->value = $value;
        $this->table = $table;
        $this->operator = $operator;
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

        $field = $this->field instanceof Expression ? $this->field : "{$this->table}.{$this->field}";
        $query = $model
            ->whereMonth($field, $this->operator, $this->value->format('m'))
            ->whereYear($field, $this->operator, $this->value->format('Y'));

        return $query;
    }
}
