<?php

namespace App\Services;

use App\Repositories\HistoricRepository;
use Illuminate\Database\Eloquent\Collection;
use App\Abstracts\AbstractBaseService as BaseService;

class HistoricService extends BaseService
{
    public function __construct(HistoricRepository $historicRepository)
    {
        parent::__construct($historicRepository);
    }

    public function listAllHistoricByUser(int $userId): Collection
    {
        return $this->repository->listAllHistoricByUser($userId);
    }
}
