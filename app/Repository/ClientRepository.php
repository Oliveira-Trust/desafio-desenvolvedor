<?php

namespace App\Repository;

use App\Model\Client;
use App\Repository\Contracts\ClientRepositoryInterface;

/**
 * @method Client[] queryToPaginate()
 */
class ClientRepository extends AbstractRepository implements ClientRepositoryInterface
{
    public function __construct(Client $model)
    {
        $this->model = $model;
    }
}