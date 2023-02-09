<?php

namespace App\Repositories\Criteria;

use App\Models\User;
use Czim\Repository\Criteria\AbstractCriteria;
use Illuminate\Database\Query\Builder;

/**
 * Class ByLikeFieldCriteria
 * @package App\Repositories\Criteria
 */
class UserByRoleCriteria extends AbstractCriteria
{
    /**
     * @var
     */
    private $roles;

    /**
     * UserByRoleCriteria constructor.
     * @param array $roles
     */
    public function __construct($roles = [])
    {
        $this->roles = $roles;
    }

    /**
     * @param $model
     * @return mixed
     */
    public function applyToQuery($model)
    {
        $query = $model->select('users.*')
            ->join('assigned_roles', function ($join) {
                $join->on('assigned_roles.entity_id', '=', 'users.id')->where('assigned_roles.entity_type', User::class);
            })
            ->join('roles', function ($join) {
//                $join->on('assigned_roles.role_id', '=', 'roles.id')->where('roles.name', $this->roles);
                $join->on('assigned_roles.role_id', '=', 'roles.id')->where(function ($q) {
                    $q->where(function ($q) {
                        $q->where('fid', '=', $this->argument('fid'))
                            ->where('roles.name', '==', $this->roles);
                    })
                        ->orWhereIn('roles.name', $this->roles);
                });
            });

        return $query;
    }
}
