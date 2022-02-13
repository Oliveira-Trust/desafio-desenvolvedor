<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\User;


class AuthRepository extends BaseRepository
{
    /** @var User */
    protected $model;

    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}