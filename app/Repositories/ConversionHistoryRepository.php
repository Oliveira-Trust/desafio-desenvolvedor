<?php

namespace App\Repositories;

use Czim\Repository\ExtendedRepository as Repository;
use App\Models\ConversionHistory;
use App\Repositories\Criteria\ByFieldEqualCriteria;
use App\Repositories\Criteria\OrderByCriteria;
use App\Repositories\Criteria\SelectCriteria;

class ConversionHistoryRepository extends Repository
{

    public function model()
    {
        return ConversionHistory::class;
    }

    public function findByDataAll()
    {
        return $this->pushCriteriaOnce(new SelectCriteria())
            ->pushCriteriaOnce(new ByFieldEqualCriteria('user_id', auth()->user()->id))
            ->pushCriteriaOnce(new OrderByCriteria('created_at', 'DESC'))->query();
    }
}
