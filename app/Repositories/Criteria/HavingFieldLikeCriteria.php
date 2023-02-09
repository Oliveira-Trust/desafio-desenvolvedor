<?php

namespace App\Repositories\Criteria;

use Czim\Repository\Criteria\AbstractCriteria;
use Illuminate\Database\Query\Builder;

/**
 * Class HavingFieldLikeCriteria
 * @package App\Repositories\Criteria
 */
class HavingFieldLikeCriteria extends AbstractCriteria
{
    /**
     * @var null
     */
    protected $field;

    /**
     * @var null
     */
    protected $value;

    /**
     * @var null
     */
    protected $table;

    /**
     * @var null
     */
    protected $isVolatileField;

    /**
     * HavingFieldLikeCriteria constructor.
     *
     * @param null $field
     * @param null $value
     * @param null $table
     * @param null isVolatileField
     */
    public function __construct($field, $value, $table = null, $isVolatileField = false)
    {
        $this->field = $field;
        $this->value = $value;
        $this->table = $table;
        $this->isVolatileField = $isVolatileField;
    }

    /**
     * @param $model
     * @return mixed
     */
    public function applyToQuery($model)
    {
        if ($this->isVolatileField) {
            return $model->havingRaw(
                "LOWER(`$this->field`) LIKE ?",
                ['%' . strtolower($this->value) . '%']
            );
        } else if (empty($this->table)) {
            $m = $this->repository->model();
            $table = with(new $m)->getTable();
        } else {
            $table = $this->table;
        }

        $query = $model->havingRaw(
            "LOWER(`${table}`.`$this->field`) LIKE ?",
            ['%' . strtolower($this->value) . '%']
        );

        return $query;
    }
}
