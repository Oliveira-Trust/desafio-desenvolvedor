<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\CurrencyConversion;
use Illuminate\Support\Facades\Auth;

class CurrencyConversionRepository extends BaseRepository
{
    /** @var CurrencyConversion */
    protected $model;

    public function __construct(CurrencyConversion $model)
    {
        parent::__construct($model);
    }

    /** @return CurrencyConversion[] */
    public function getAll(): array
    {
        return
            $this->model
                ->newQuery()
                ->where('user_id', Auth::user()->id)
                ->get()
                ->all();
    }
}
