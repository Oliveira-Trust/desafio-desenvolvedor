<?php

namespace App\Actions\ConversionRate;

use App\Actions\Action;
use App\Models\ConversionRate;
use Illuminate\Support\Facades\Cache;

class GetConversionRate extends Action
{
    public function handle(float $amount): float
    {
        $conversionRate = Cache::rememberForever('conversionRate', fn () => ConversionRate::first());

        return ($amount <= $conversionRate->value) ? $conversionRate->down : $conversionRate->up;
    }
}
