<?php

namespace App\Repositories\Criteria;

use Czim\Repository\Criteria\AbstractCriteria;
use Illuminate\Database\Query\Expression;

/**
 * Class ByDateBetweenCriteria
 * @package App\Repositories\Criteria
 */
class ByDateBetweenCriteria extends AbstractCriteria
{
    /**
     * @var null
     */
    private $field;
    /**
     * @var null
     */
    private $periodBegin;
    /**
     * @var null
     */
    private $periodEnd;

    /**
     * @var null
     */
    private $table;

    /**
     * ByDateBetweenCriteria constructor.
     * @param null $field
     * @param $periodBegin
     * @param null $periodEnd
     * @param null $table
     */
    public function __construct($field = null, $periodBegin, $periodEnd = null, $table = null)
    {
        if (!$periodEnd) {
            $periodEnd = now();
        }

        $this->field = $field;
        $this->periodBegin = $periodBegin;
        $this->periodEnd = $periodEnd;
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

        $field = $this->field instanceof Expression ? $this->field : "{$this->table}.{$this->field}";
        return $model->whereBetween($field, [$this->periodBegin, $this->periodEnd]);
    }
}
