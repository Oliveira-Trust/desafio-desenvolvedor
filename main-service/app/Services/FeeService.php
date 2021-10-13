<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\StatusType;
use App\Models\Fee;
use App\Repositories\Contracts\FeeRepositoryInterface;

class FeeService
{
    protected $feedRepository;

    public function __construct(FeeRepositoryInterface $feedRepository)
    {
        $this->feedRepository = $feedRepository;
    }

    public function getAllFees() : array
    {
        return $this->feedRepository->getAll()->toArray();
    }

    public function getAllActiveFees() : array
    {
        return $this->feedRepository->findWhere('status', StatusType::ACTIVATED)
                                    ->toArray();
    }

    public function getFeeObj(int $status) : Fee
    {
        $result = $this->feedRepository->findWhere('status', $status)->toArray();
        return Fee::createFromEloquent($result);
    }

    public function getFeeById(int $id) : Fee
    {
        return $this->feedRepository->findById($id);
    }

    public function storeFee(array $request) : Fee
    {
        return $this->feedRepository->store($request);
    }

    public function updateFee(int $id, array $request) : bool
    {
        if (isset($request['status']) == StatusType::ACTIVATED) {
            $this->feedRepository->updateAllStatusToInactive();
        }
        return $this->feedRepository->update($id, $request);
    }
}
