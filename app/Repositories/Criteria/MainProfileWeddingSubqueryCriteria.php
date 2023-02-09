<?php

namespace App\Repositories\Criteria;

use App\Models\Company;
use App\Models\Profile;
use Czim\Repository\Criteria\AbstractCriteria;

/**
 * Class MainProfileWeddingSubqueryCriteria
 * @package App\Repositories\Criteria
 */
class MainProfileWeddingSubqueryCriteria extends AbstractCriteria
{
    protected $company;

    protected $profile;

    public function __construct(Company $company, Profile $profile)
    {
        $this->company = $company;
        $this->profile = $profile;
    }

    public function applyToQuery($model)
    {
        $m = $this->repository->model();
        $table = with(new $m)->getTable();
        $mainProfile = $this->profile;

        return $model->whereIn("{$table}.id", function ($query) use ($table, $mainProfile) {
            $query->select("{$table}.id")
                ->from($table)
                ->join('wedding_profiles', function ($join) use ($table, $mainProfile) {
                    $join->on('wedding_profiles.wedding_id', "{$table}.id")
                        ->where('wedding_profiles.profile_id', $mainProfile->id);
                })->where("{$table}.company_id", $this->company->id);
        });
    }
}

