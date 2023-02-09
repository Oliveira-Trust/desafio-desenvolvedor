<?php

namespace App\Repositories\Criteria;

use Czim\Repository\Criteria\AbstractCriteria;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

/**
 * Class CommunicationForAllCompaniesCriteria
 * @package App\Repositories\Criteria
 */
class WhereFieldNotInTableCriteria extends AbstractCriteria
{
    /**
     * @var array
     */
    private $fields;
    private $secondTableName;
    /**
     * @var array
     */
    private $secondTableWhereFieldValue;

    /**
     * WhereFieldNotInTableCriteria constructor.
     * @param array $fields
     * @param $secondTableName
     * @param array $secondTableWhereFieldValue
     */
    public function __construct(array $fields, $secondTableName, array $secondTableWhereFieldValue = [])
    {
        $this->fields = $fields;
        $this->secondTableName = $secondTableName;
        $this->secondTableWhereFieldValue = $secondTableWhereFieldValue;
    }

    public function applyToQuery($model)
    {
        if (empty($this->table)) {
            $m = $this->repository->model();
            $this->table = with(new $m)->getTable();
        }

        $query = $model->whereNotExists(function ($query) {
            $query->select(DB::raw(1))->from($this->secondTableName);
            foreach ($this->fields as $firstTableField => $secondTableField) {
                $query->whereRaw($this->table . "." . $firstTableField . " = " . $this->secondTableName . "." . $secondTableField);
            }

            if (count($this->secondTableWhereFieldValue) > 0) {
                $this->joinWhere($query, $this->secondTableName, $this->secondTableWhereFieldValue);
            }

        });

        return $query;
    }

    protected function joinWhere($query, $table, array $where)
    {
        foreach ($where as $field => $value) {
            if (!is_array($value)) {
                $field = $table . '.' . $field;
                $query->where($field, $value);
            } else if (count($value) === 3) {
                list($field, $operator, $search) = $value;
                $field = $table . '.' . $field;
                $query->where($field, $operator, $search);
            } elseif (count($value) === 2) {
                list($field, $search) = $value;
                $field = $table . '.' . $field;
                $query->where($field, $search);
            }
        }
    }
}
