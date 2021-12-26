<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Domain\Contracts\Helpers\ValidateInterface;

class Validate implements ValidateInterface
{
    public function isEmptyArray(Array $array): bool
    {
        if(count($array) == 0) {
            return true;
        }
        return false;
    }
    public function unsetEmptyData(array $array): array
    {
        foreach($array as $key => $value){
            if($value === ''){
                unset($array[$key]);
            }
        }
        return $array;
    }
}
