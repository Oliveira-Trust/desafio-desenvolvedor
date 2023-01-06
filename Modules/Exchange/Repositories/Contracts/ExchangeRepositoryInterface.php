<?php

namespace Modules\Exchange\Repositories\Contracts;

use Modules\User\Entities\User;

interface ExchangeRepositoryInterface
{
    public function list(User $user);
    public function snapShot(array $data);
}
