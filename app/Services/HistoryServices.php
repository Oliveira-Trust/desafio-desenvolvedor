<?php

declare(strict_types=1);

namespace App\Services;

use App\Repository\HistoryRepository;
use Illuminate\Support\Collection;

class HistoryServices
{
    private HistoryRepository $historyRepository;

    public function __construct(HistoryRepository $historyRepository)
    {
        $this->historyRepository = $historyRepository;
    }

    public function getAll(): Collection
    {
        return $this->historyRepository->findAll();
    }
}
