<?php

namespace App\Repositories\Criteria;

use Czim\Repository\Criteria\AbstractCriteria;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\Expression;

/**
 * Class GroupByCriteria
 * @package App\Repositories\Criteria
 */
class AggregateByCriteria extends AbstractCriteria
{
    /**
     * @var
     */
    private $aggregationField;

    /**
     * @var
     */
    private $groupByField;

    /**
     * @var array
     */
    private $otherFields;

    /**
     * @var
     */
    private $aggregationFunction;

    /**
     * GroupByCriteria constructor.
     * @param $aggregationField
     * @param $groupByField
     * @param array|Expression $otherFields
     * @param string $aggregationFunction
     */
    public function __construct($aggregationField, $groupByField, $otherFields, $aggregationFunction = 'COUNT')
    {
        $this->aggregationField = $aggregationField;
        $this->groupByField = $groupByField;
        $this->otherFields = $otherFields;
        $this->aggregationFunction = $aggregationFunction;
    }

    /**
     * @param $model
     * @return mixed
     */
    public function applyToQuery($model)
    {
        $query = $model->groupBy($this->groupByField);
        $otherFields = is_array($this->otherFields) ? implode(",", collect($this->otherFields)->map(function($item) {
            if ($item == '*') return $item;
            return "`{$item}`";
        })->toArray()) : $this->otherFields;
        $query->select(\DB::raw("{$this->aggregationFunction}(`{$this->aggregationField}`) AS total, {$otherFields}"));

        return $query;
    }
}
