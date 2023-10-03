<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class CurrencyQuotationApiException extends Exception
{
    public function report()
    {
        // Log the exception along with the stack trace
        Log::error($this->getMessage(), ['exception' => $this]);

        return true;
    }
}
