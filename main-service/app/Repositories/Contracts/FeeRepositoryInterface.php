<?php

namespace App\Repositories\Contracts;

interface FeeRepositoryInterface
{
    public function updateAllStatusToInactive(): void;
}
