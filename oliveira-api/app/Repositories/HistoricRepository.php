<?php

namespace App\Repositories;

use App\Models\Historic;
use App\Abstracts\AbstractBaseRepository as BaseRepository;
use Illuminate\Database\Eloquent\Collection;

class HistoricRepository extends BaseRepository
{
    public function __construct()
    {
        $this->setModel(Historic::class);
    }

    public function listAllHistoricByUser(int $userId): Collection
    {
        $t = $this->findBy([
            'user_id' => $userId
        ])->with('user')->toSql();

        return $this->findBy([
            'user_id' => $userId
        ])
        ->with('user')
        ->get();
    }
}
