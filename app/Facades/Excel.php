<?php

declare(strict_types=1);

namespace App\Facades;

use App\Services\Patterns\ExcelFacade;
use Illuminate\Support\Facades\Facade;

/**
 * @method static csv(array $data, string $fileName, string $delimiter = ';'): bool
 */class Excel extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return ExcelFacade::class;
    }
}
