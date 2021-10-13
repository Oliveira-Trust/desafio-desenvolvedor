<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Enums\StatusType;
use App\Models\Fee;
use App\Repositories\Contracts\FeeRepositoryInterface;

class FeeRepository extends BaseRepository implements FeeRepositoryInterface
{
    public function model() : string
    {
        return Fee::class;
    }

    public function updateAllStatusToInactive(): void
    {
        $data['status'] = StatusType::INACTIVATED;
        $this->model->where('status', StatusType::ACTIVATED)->update($data);
    }
}
