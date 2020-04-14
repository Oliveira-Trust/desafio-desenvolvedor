<?php

namespace App\Repositories;

use App\Models\Client;
use App\Repositories\Contracts\ClientRepositoryInterface;

/**
 * @method Client[] findBy()
 */
class ClientRepository extends AbstractRepository implements ClientRepositoryInterface
{
    public function __construct(Client $model)
    {
        $this->model = $model;
    }
}