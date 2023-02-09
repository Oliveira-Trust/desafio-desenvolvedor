<?php

namespace App\Repositories\Criteria;

use Carbon\Carbon;
use Czim\Repository\Criteria\AbstractCriteria;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\DB;

/**
 * Class CommunicationNotReadAndForAllCompaniesCriteria
 * @package App\Repositories\Criteria
 */
class CommunicationNotReadAndForAllCompaniesCriteria extends AbstractCriteria
{
    private $companyId;
    private $userId;

    /**
     * CommunicationNotReadAndForAllCompaniesCriteria constructor.
     * @param $companyId
     * @param $userId
     */
    public function __construct($companyId, $userId)
    {
        $this->companyId = $companyId;
        $this->userId = $userId;
    }

    public function applyToQuery($model)
    {
        if (empty($this->table)) {
            $m = $this->repository->model();
            $this->table = with(new $m)->getTable();
        }

        $query = $model->whereNotExists(function ($query) {
            $query->select(DB::raw(1))->from('communication_companies');
            $query->whereRaw("communications.id = communication_companies.communication_id");
            $query->where('communications.is_url', '=', false);
        })->whereNotExists(function ($query) {
            $query->select(DB::raw(1))->from('communication_reads');
            $query->whereRaw("communications.id = communication_reads.communication_id");
            $query->where('communication_reads.company_id', $this->companyId);
            $query->where('communication_reads.user_id', $this->userId);
        })->where(function ($query) {
            $query->whereNull('communications.expires_at');
            $query->orWhereDate('communications.expires_at', '>=', Carbon::now());
        });

        return $query;
    }
}
