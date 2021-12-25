<?php

declare(strict_types=1);

namespace App\Helpers;

class Validate
{
    public function isEmptyArray(Array $array)
    {
        $isEmpty = false;
        foreach($array as $value){
            if($value === ''){
                $isEmpty = true;
            }
        }
        return $isEmpty;
    }
    public function unsetEmptyData(Array $array)
    {
        foreach($array as $key => $value){
            if($value === ''){
                unset($array[$key]);
            }
        }
        return $array;
    }
}
