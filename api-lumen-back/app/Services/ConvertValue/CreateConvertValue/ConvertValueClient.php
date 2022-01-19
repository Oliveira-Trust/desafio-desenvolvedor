<?php

namespace App\Services\ConvertValue\CreateConvertValue;

use App\Models\ConvertedValue;
use Illuminate\Support\Facades\DB;

class ConvertValueClient extends ConvertValueAbstract
{
    /**
     * Handle.
     *
     * @return ConvertedValue|null
     */
    public function handle() :? ConvertedValue
    {
        $convertValue = null;

        DB::transaction(function () use(&$convertValue){
            $convertValue = $this->execConvertion();
        });

        return $convertValue;
    }
}
