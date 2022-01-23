<?php

namespace App\Services\ConvertValue;

use App\Models\CurrencyConversion;
use Illuminate\Support\Facades\DB;

class ConvertValueClient extends ConvertValueAbstract
{

    public function handle() :? CurrencyConversion
    {
        $convertValue = null;

        DB::transaction(function () use(&$convertValue){
            $convertValue = $this->execConvertion();
        });

        return $convertValue;
    }
}
