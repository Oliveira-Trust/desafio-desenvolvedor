<?php

namespace App\Repositories\Criteria;

use Czim\Repository\Criteria\AbstractCriteria;

/**
 * Class ByFindWhereCriteria
 * @package App\Repositories\Criteria
 */
class ByFindWhereCriteria extends AbstractCriteria
{
    protected $where;

    protected $table;

    /**
     * ByFindWhereCriteria constructor.
     * @param null $where
     * @param null $table
     */
    public function __construct(array $where, $table = null)
    {
        $this->where = $where;
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

        foreach ($this->where as $field => $value) {
            if (is_array($value)) {
                if (count($value) === 3) {
                    list($field, $operator, $search) = $value;
                    $field = "{$this->table}.{$field}";

                    $model->where($field, $operator, $search);
                    continue;
                } elseif (count($value) === 2) {
                    list($field, $search) = $value;
                    $field = "{$this->table}.{$field}";

                    $model->where($field, $search);
                    continue;
                }
            }

            $field = "{$this->table}.{$field}";
            $model->where($field, $value);
        }

        return $model;
    }
}
