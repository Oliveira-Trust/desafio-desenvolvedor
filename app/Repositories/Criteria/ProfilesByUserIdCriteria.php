<?php

namespace App\Repositories\Criteria;

use Czim\Repository\Criteria\AbstractCriteria;
use Illuminate\Database\Query\Builder;

/**
 * Class ProfilesByUserIdCriteria
 * @package App\Repositories\Criteria
 */
class ProfilesByUserIdCriteria extends AbstractCriteria
{
    /**
     * @var
     */
    private $userId;

    /**
     * ProfilesByUserIdCriteria constructor.
     * @param $userId
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @param $model
     * @return mixed
     */
    public function applyToQuery($model)
    {
        $query = $model
            ->select('profiles.*')
            ->join('user_profiles', function ($join) {
                $join->on('profiles.id', '=', 'user_profiles.profile_id');
                $join->where('user_profiles.user_id', $this->userId);
            });

        return $query;
    }
}
