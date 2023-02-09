<?php

namespace App\Repositories\Criteria;

use App\Models\Company;
use Czim\Repository\Criteria\AbstractCriteria;
use Illuminate\Support\Facades\DB;

/**
 * Class DistinctCriteria
 * @package App\Repositories\Criteria
 */
class DistinctByCreatedAtCriteria extends AbstractCriteria
{
    /**
     * @var Company
     */
    private $company;
    /**
     * @var int
     */
    private $limit;

    /**
     * DistinctByCreatedAtCriteria constructor.
     * @param Company $company
     * @param int $limit
     */
    public function __construct(Company $company, int $limit = 1)
    {
        $this->company = $company;
        $this->limit = $limit;
    }

    public function applyToQuery($model)
    {
        return $model
            ->select(DB::raw('DISTINCT date(created_at) AS created_at'))
            ->where('company_id', $this->company->id)
            ->orderBy('created_at', 'DESC')
            ->limit($this->limit);
    }
}
