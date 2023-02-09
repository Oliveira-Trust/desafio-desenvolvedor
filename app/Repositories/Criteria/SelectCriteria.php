<?php

namespace App\Repositories\Criteria;

use Czim\Repository\Criteria\AbstractCriteria;
use Illuminate\Support\Facades\DB;

/**
 * Class SelectCriteria
 * @package App\Repositories\Criteria
 */
class SelectCriteria extends AbstractCriteria
{
    protected $columns;

    protected $useTable;

    public function __construct(array $columns = ['*'], $useTable = true)
    {
        $this->columns = $columns;
        $this->useTable = $useTable;
    }

    public function applyToQuery($model)
    {
        $m = $this->repository->model();
        $table = with(new $m)->getTable();
        $columns = [];
        foreach ($this->columns as $key => $column) {
            if(is_object($column)){
                $columns[] = $column;
                continue;
            }

            $columns[] = $this->useTable ? "${table}.${column}" : "${column}";
        }

        return $model->select($columns);
    }

    public function getColumns(): array
    {
        return $this->columns;
    }
}
