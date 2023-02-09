<?php

namespace App\Repositories\Criteria;

use Czim\Repository\Criteria\AbstractCriteria;
use RuntimeException;

/**
 * Class JoinCriteria
 * @package App\Repositories\Criteria
 */
class JoinCriteria extends AbstractCriteria
{
    /**
     * @var null
     */
    protected $linkTable;
    /**
     * @var null
     */
    protected $linkTableAlias;
    /**
     * @var null
     */
    protected $foreignKey;
    /**
     * @var null
     */
    protected $where;
    /**
     * @var null
     */
    protected $columns;
    /**
     * @var null
     */
    protected $localKey;
    /**
     * @var null
     */
    protected $localTable;

    /**
     * JoinCriteria constructor.
     * @param null $linkTable
     * @param null $foreignKey
     * @param array $where
     * @param array $columns
     * @param string $localKey
     * @param null $localTable
     */
    public function __construct(
        $linkTable,
        $foreignKey,
        array $where = [],
        array $columns = [],
        $localKey = 'id',
        $localTable = null
    ) {
        if (!is_array($foreignKey) && !is_array($localKey)) {
            $foreignKey = [$foreignKey];
            $localKey = [$localKey];
        } else if ((is_array($foreignKey) && !is_array($localKey))
            || (!is_array($foreignKey) && is_array($localKey))
        ) {
            throw new RuntimeException("The type of local keys must be the same of foreign keys");
        } else if (count($foreignKey) != count($localKey)) {
            throw new RuntimeException("The quantity of local keys must be equal of foreign keys");
        }

        $this->linkTable = $linkTable;
        $this->linkTableAlias = $linkTable;

        if (is_array($linkTable)) {
            if (count($linkTable) != 2) {
                throw new RuntimeException("Invalid table alias settings given");
            }

            $tableName = array_shift($linkTable);
            $newTableName = array_shift($linkTable);

            $this->linkTable = DB::raw("{$tableName} as {$newTableName}");
            $this->linkTableAlias = $newTableName;
        }

        $this->foreignKey = $foreignKey;
        $this->where = $where;
        $this->columns = $columns;
        $this->localKey = $localKey;
        $this->localTable = $localTable;
    }

    /**
     * @param $model
     * @return mixed
     */
    public function applyToQuery($model)
    {
        $m = $this->repository->makeModel();
        $table = !$this->localTable ? $m->getTable() : $this->localTable;

        $query = $model->join($this->linkTable, function ($join) use ($table) {
            for ($i = 0; $i < count($this->foreignKey); $i++) {
                if (is_array($this->localKey[$i])) {
                    $join->on($this->linkTableAlias . '.' . $this->foreignKey[$i], '=', $this->localKey[$i][0] . '.' . $this->localKey[$i][1]);
                    continue;
                }

                $join->on($this->linkTableAlias . '.' . $this->foreignKey[$i], '=', $table . '.' . $this->localKey[$i]);
            }

            $this->joinWhere($join, $this->linkTableAlias, $this->where);
        });

        if ($this->columns) {
            $query->select($this->columns);
        }

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
