<?php

namespace App\Repositories\Criteria;

use Czim\Repository\Criteria\AbstractCriteria;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\Expression;

/**
 * Class OrWhereCriteria
 * @package App\Repositories\Criteria
 */
class OrWhereCriteria extends AbstractCriteria
{
    /**
     * @var null
     */
    private $where;

    /**
     * @var null
     */
    private $table;

    /**
     * ByFieldEqualCriteria constructor.
     * @param null $where
     * @param null $table
     */
    public function __construct(array $where = [], $table = null)
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
        if (empty($table)) {;
            $m = $this->repository->make([]);
            $this->table = $m->getTable();
        }

        return $model->where(function ($qBuilder) {
            $this->joinOrWhere($qBuilder, $this->table, $this->where);
        });
    }

    protected function joinOrWhere($query, $table, array $where)
    {
        foreach ($where as $field => $value) {
            if (!is_array($value)) {
                $field = $table . '.' . $field;
                $query->orWhere($field, $value);
            } else if (count($value) === 3) {
                list($field, $operator, $search) = $value;
                $field = $table . '.' . $field;
                $query->orWhere($field, $operator, $search);
            } elseif (count($value) === 2) {
                list($field, $search) = $value;
                $field = $table . '.' . $field;
                $query->orWhere($field, $search);
            }
        }
    }
}
