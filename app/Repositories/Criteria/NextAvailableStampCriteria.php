<?php

namespace App\Repositories\Criteria;

use App\Models\Stamp;
use Czim\Repository\Criteria\AbstractCriteria;
use Illuminate\Database\Query\Builder;
use App\Models\Company;
use App\Models\Act;

/**
 * Class NextAvailableStampCriteria
 * @package App\Repositories\Criteria
 */
class NextAvailableStampCriteria extends AbstractCriteria
{
    /**
     * @var Company
     */
    private $company;
    /**
     * @var Act
     */
    private $act;
    /**
     * @var null
     */
    private $mainStamp;

    /**
     * NextAvailableStampCriteria constructor.
     * @param Company $company
     * @param Act $act
     * @param null $mainStamp
     */
    public function __construct(Company $company, Act $act, Stamp $mainStamp = null)
    {
        $this->company = $company;
        $this->act = $act;
        $this->mainStamp = $mainStamp;
    }

    /**
     * @param $model
     * @return mixed
     */
    public function applyToQuery($model)
    {
        $query = $model->where('company_id', $this->company->id)
            ->whereNull('process_id')
            ->whereNull('deleted_at')
            ->whereNull('reserved_at')
            ->where(function ($qBuilder) {
                $qBuilder->orWhere('act_id', $this->act->id)
                    ->orWhere('is_wildcard', true);
            })->orderBy('counter', 'ASC');

        if (empty($this->mainStamp)) {
            return $query->whereNull('parent_stamp_code');
        }

        return $query->where('parent_stamp_code', '=', $this->mainStamp->stamp_code);
    }
}
