<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Domain\Contracts\Helpers\ValidateInterface;

class Validate implements ValidateInterface
{
    public function isEmptyArray(array $array): bool
    {
        if (count($array) == 0) {
            return true;
        }
        return false;
    }
    public function hasEmptyValue(array $array): bool
    {
        $hasEmpty = false;
        foreach ($array as $key => $value) {
            if ($value == '') {
                $hasEmpty = true;
            }
        }
        return $hasEmpty;
    }
    public function unsetEmptyData(array $array): array
    {
        foreach ($array as $key => $value) {
            if ($value === '') {
                unset($array[$key]);
            }
        }
        return $array;
    }
}
