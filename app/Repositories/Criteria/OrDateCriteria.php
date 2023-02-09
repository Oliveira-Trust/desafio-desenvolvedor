<?php

namespace App\Repositories\Criteria;

use Czim\Repository\Criteria\AbstractCriteria;
use Illuminate\Database\Query\Expression;

/**
 * Class ByFieldLessThanCriteria
 * @package App\Repositories\Criteria
 */
class OrDateCriteria extends AbstractCriteria
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
     * @param null $value
     * @param string $operator
     * @param null $table
     */
    public function __construct($field, array $value, $operator = '=', $table = null)
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
        $query = $model->where(function ($where) use ($field) {
            foreach ($this->value as $value) {
                $where->orWhereDate($field, $this->operator, $value);
            }
        });

        return $query;
    }
}
