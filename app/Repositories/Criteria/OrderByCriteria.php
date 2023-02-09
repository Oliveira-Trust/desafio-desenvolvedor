<?php

namespace App\Repositories\Criteria;

use Czim\Repository\Criteria\AbstractCriteria;
use Illuminate\Database\Query\Builder;

/**
 * Class OrderByCriteria
 * @package App\Repositories\Criteria
 */
class OrderByCriteria extends AbstractCriteria
{
    /**
     * @var string
     */
    private $field;
    /**
     * @var string
     */
    private $order;

    /**
     * @var bool
     */
    protected $table;

    /**
     * OrderByCriteria constructor.
     * @param string $field
     * @param string $order
     * @param bool $table
     */
    public function __construct($field = 'created_at', $order = 'ASC', $table = null)
    {
        $this->field = $field;
        $this->order = $order;
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

        $field = $this->table ? "$this->table.$this->field" : $this->field;

        return $model->orderBy($field, $this->order);
    }
}
