<?php

namespace App\Repositories\Criteria;

use Czim\Repository\Criteria\AbstractCriteria;

/**
 * Class DocumentsByUserIdCriteria
 * @package App\Repositories\Criteria
 */
class DocumentsByUserIdCriteria extends AbstractCriteria
{
    /**
     * @var
     */
    private $userId;
    /**
     * @var null
     */
    private $profileId;

    /**
     * DocumentsByUserIdCriteria constructor.
     * @param $userId
     * @param null $profileId
     */
    public function __construct($userId, $profileId = null)
    {
        $this->userId = $userId;
        $this->profileId = $profileId;
    }

    /**
     * @param $model
     * @return mixed
     */
    public function applyToQuery($model)
    {
        $query = $model->select('documents.*')->join('profile_documents', function ($join) {
            $join->on('documents.id', '=', 'profile_documents.document_id');
            if (!empty($this->profileId)) {
                $join->where('profile_documents.profile_id', $this->profileId);
            }
        })->join('user_profiles', function ($join) {
            $join->on('profile_documents.profile_id', '=', 'user_profiles.profile_id')->where('user_profiles.user_id', $this->userId);
        })->with(['documentFields', 'profile', 'profiles'])->distinct();

        return $query;
    }
}
