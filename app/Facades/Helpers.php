<?php

declare(strict_types=1);

namespace App\Facades;

use App\Services\Patterns\HelpersFacade;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Facade;

/**
 * @method static generateToken(Authenticatable|null $user): string
 * @method static decodeRawJWT(): ?array
 * @method static authUser(): ?User
 */class Helpers extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return HelpersFacade::class;
    }
}
