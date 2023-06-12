<?php

namespace Modules\Converter\Observers;

use Modules\Converter\Entities\ConversionHistory;
use Illuminate\Support\Facades\Mail;
use Modules\Converter\Emails\SendConversionDetailsEmail;

class ConversionHistoryObserver
{
    /**
     * Handle the ConversionHistory "created" event.
     */
    public function created(ConversionHistory $conversionHistory): void
    {
        Mail::to($conversionHistory->user->email)->send(new SendConversionDetailsEmail($conversionHistory));
    }
}
