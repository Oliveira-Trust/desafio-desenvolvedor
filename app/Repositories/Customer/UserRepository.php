<?php

namespace App\Repositories\Customer;
namespace App\Repositories\Customer;

use App\Abstracts\BaseRepository;
use App\EloquentModels\Customers\User;

class UserRepository extends BaseRepository
{

    public function model()
    {
        return User::class;
    }

}
