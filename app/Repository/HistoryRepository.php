<?php

declare(strict_types=1);

namespace App\Repository;

use App\Facades\Helpers;
use App\Models\History;
use Illuminate\Database\Eloquent\Collection;

class HistoryRepository
{
    public function findAll(): Collection
    {
        return Helpers::authUser()
            ->select('id', 'name')
            ->with(['histories' => ['payments:id,name']])
            ->get();
    }

    public function create(array $conversion): History
    {
        unset($conversion['payment_type']);

        return History::create($conversion);
    }
}
