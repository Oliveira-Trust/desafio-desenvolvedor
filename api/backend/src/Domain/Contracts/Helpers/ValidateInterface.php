<?php

declare(strict_types=1);

namespace App\Domain\Contracts\Helpers;


interface ValidateInterface
{
    public function isEmptyArray(array $array): bool;
    public function hasEmptyValue(array $array): bool;
    public function unsetEmptyData(array $array): array;
}