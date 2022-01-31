<?php
namespace App\Repositories\Admin;


use App\Abstracts\BaseRepository;
use App\EloquentModels\Admin\User;

class UserRepository extends BaseRepository
{



    public function model()
    {
        return User::class;
    }

    /**
     * UserRepository constructor.
     */
    public function withUserRole()
    {
        $this->model = $this->model->with(['userRole']);
        return $this;
    }
}
