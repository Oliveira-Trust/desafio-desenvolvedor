<?php

namespace App\Observers;

use App\Jobs\CurrencyConversionJob;
use App\Models\CurrencyConversion;
use Illuminate\Support\Facades\Auth;


class CurrencyConversionObserver
{
    /**
     * Handle the CurrencyConversion "created" event.
     *
     * @param  \App\Models\CurrencyConversion  $currencyConversion The CurrencyConversion model instance.
     * @return void
     */

    public function created(CurrencyConversion $currencyConversion)
    {
        $user = Auth::user(); 
        $email = $user->email; 

        $params = [
            'emailTo' => $email,
            'emailFrom' => $email,
            'conversion_value' => $currencyConversion->conversion_value,
            'source_currency' => $currencyConversion->source_currency,
            'target_currency' => $currencyConversion->target_currency,
            'value_target_currency' => $currencyConversion->value_target_currency,
        ];

       CurrencyConversionJob::dispatch($params); 
    }

    /**
     * Handle the CurrencyConversion "updated" event.
     *
     * @param  \App\Models\CurrencyConversion  $currencyConversion
     * @return void
     */
    public function updated(CurrencyConversion $currencyConversion)
    {
        //
    }

    /**
     * Handle the CurrencyConversion "deleted" event.
     *
     * @param  \App\Models\CurrencyConversion  $currencyConversion
     * @return void
     */
    public function deleted(CurrencyConversion $currencyConversion)
    {
        //
    }

    /**
     * Handle the CurrencyConversion "restored" event.
     *
     * @param  \App\Models\CurrencyConversion  $currencyConversion
     * @return void
     */
    public function restored(CurrencyConversion $currencyConversion)
    {
        //
    }

    /**
     * Handle the CurrencyConversion "force deleted" event.
     *
     * @param  \App\Models\CurrencyConversion  $currencyConversion
     * @return void
     */
    public function forceDeleted(CurrencyConversion $currencyConversion)
    {
        //
    }
}
