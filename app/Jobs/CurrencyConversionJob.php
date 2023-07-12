<?php

namespace App\Jobs;

use App\Mail\CurrencyConversionMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class CurrencyConversionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $params;
    /**
     * Create a new job instance.
     *
     * @param array $params The parameters for the currency conversion and email sending.
     * @return void
     */

    public function __construct($params)
    {
        $this->params = $params;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->CurrencyConversionMail($this->params);
    }

    /**
     * Sends an email with the currency conversion details.
     *
     * @param array $params The parameters for the email sending.
     * @return void
     */
    
    public function CurrencyConversionMail($params)
    {
        $emailContent = "Currency Conversion";
        $emailSubject = "Currency Conversion";

        Mail::to($params['emailTo'])->send(new CurrencyConversionMail(
            $emailContent,
            $emailSubject,
            $params['emailTo'],
            $params['emailFrom'],
            $params['conversion_value'],
            $params['source_currency'],
            $params['target_currency'],
            $params['value_target_currency'],
        ));
    }
}
