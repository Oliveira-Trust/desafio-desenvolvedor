<?php

namespace App\Repositories\Criteria;

use Czim\Repository\Criteria\AbstractCriteria;
use RuntimeException;

/**
 * Class ConditionalProcessTypeActJoinCriteria
 * @package App\Repositories\Criteria
 */
class ConditionalProcessTypeActJoinCriteria extends AbstractCriteria
{
    /**
     * @var null
     */
    protected $linkTable;

    /**
     * @var null
     */
    protected $foreignKey;

    /**
     * @var null
     */
    protected $localKey;

    /**
     * @var null
     */
    protected $localTable;

    /**
     * @var null
     */
    protected $temporaryLocalTable;

    /**
     * ConditionalProcessTypeActJoinCriteria constructor.
     *
     * @param null $temporaryLocalTable
     */
    public function __construct($temporaryLocalTable) {
        $this->linkTable = 'acts';
        $this->foreignKey = 'act_code';
        $this->localKey = 'act_code';
        $this->temporaryLocalTable = $temporaryLocalTable;
    }

    /**
     * @param $model
     * @return mixed
     */
    public function applyToQuery($model)
    {
        $m = $this->repository->makeModel();
        $this->localTable = $m->getTable();

        // act_code + state_id -> futuramente será usado act_id
        $query = $model->join($this->linkTable, function ($join) {
            $join->on(function ($innerJoin) {
                $innerJoin->on($this->linkTable . '.' . $this->foreignKey, '=', $this->localTable . '.' . $this->localKey)
                    ->orOn($this->linkTable . '.' . $this->foreignKey, '=', $this->temporaryLocalTable . '.' . $this->localKey);
            })->on($this->linkTable . '.' . 'state_id', '=',  $this->localTable . '.' . 'state_id');
        });

        return $query;
    }
}
