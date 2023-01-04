<?php

namespace Modules\User\Repositories\Contracts;

interface UserRepositoryInterface
{
    public function create(array $data);
    public function findByColumn(array $data);
}
