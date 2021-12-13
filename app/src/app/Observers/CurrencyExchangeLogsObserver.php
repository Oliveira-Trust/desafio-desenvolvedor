<?php

namespace App\Observers;

use App\Jobs\SendMailJob;
use App\Mail\CurrencyExchangeMail;
use App\Models\CurrencyExchangeLogs;
use App\Models\User;
use App\Modules\CurrencyExchange\Module as CurrencyExchange;

class CurrencyExchangeLogsObserver
{
    /**
     * Handle the currency exchange logs "created" event.
     *
     * @param  \App\Models\CurrencyExchangeLogs  $currencyExchangeLogs
     * @return void
     */
    public function created(CurrencyExchangeLogs $currencyExchangeLogs)
    {
        $user = User::find($currencyExchangeLogs->user_id);

        SendMailJob::dispatch(new CurrencyExchangeMail($currencyExchangeLogs, $user), $user->email);
    }

    /**
     * Handle the currency exchange logs "updated" event.
     *
     * @param  \App\Models\CurrencyExchangeLogs  $currencyExchangeLogs
     * @return void
     */
    public function updated(CurrencyExchangeLogs $currencyExchangeLogs)
    {
        //
    }

    /**
     * Handle the currency exchange logs "deleted" event.
     *
     * @param  \App\Models\CurrencyExchangeLogs  $currencyExchangeLogs
     * @return void
     */
    public function deleted(CurrencyExchangeLogs $currencyExchangeLogs)
    {
        //
    }

    /**
     * Handle the currency exchange logs "restored" event.
     *
     * @param  \App\Models\CurrencyExchangeLogs  $currencyExchangeLogs
     * @return void
     */
    public function restored(CurrencyExchangeLogs $currencyExchangeLogs)
    {
        //
    }

    /**
     * Handle the currency exchange logs "force deleted" event.
     *
     * @param  \App\Models\CurrencyExchangeLogs  $currencyExchangeLogs
     * @return void
     */
    public function forceDeleted(CurrencyExchangeLogs $currencyExchangeLogs)
    {
        //
    }
}
