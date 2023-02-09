<?php

namespace App\Repositories\Criteria;

use Czim\Repository\Criteria\AbstractCriteria;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\Expression;

/**
 * Class ProtocolBookAwaitingPrintCriteria
 * @package App\Repositories\Criteria
 */
class ProtocolBookAwaitingPrintCriteria extends AbstractCriteria
{
    /**
     * @param $model
     * @return mixed
     */
    public function applyToQuery($model)
    {
        $m = $this->repository->make([]);
        $table = $m->getTable();

        return $model->where(function ($qBuilder) {
            $qBuilder->whereNull('imported_at')
                ->orWhere(function ($orBuilder) {
                    $orBuilder->whereNotNull('imported_at')
                        ->where('has_legacy_print', true);
                });
        });
    }
}
