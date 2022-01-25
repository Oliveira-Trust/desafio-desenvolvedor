<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Quote;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class QuoteRepository extends BaseRepository
{
    protected string $model = Quote::class;

    public function save(array $attributes)
    {
        $this->createModel()->fill($attributes)->save();
    }

    public function getQuotes(int $userId): LengthAwarePaginator
    {
        return $this->createModel()->where('userId', $userId)->paginate(10);
    }

    public function findByOne(string $key, string $value)
    {
        return $this->createModel()->where('userId', Auth::user()->id)->where($key, $value)->first();
    }
}