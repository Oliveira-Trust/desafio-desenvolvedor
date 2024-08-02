<?php

namespace App\Jobs;

use App\Models\CurrencyConversion;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConversionCurrencyMarkdown;
use Illuminate\Support\Facades\Log;
class SendConversionCurrencyToUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected CurrencyConversion $currencyConversion;
    protected User $user;
    public function __construct(User $user, CurrencyConversion $currencyConversion)
    {
        $this->currencyConversion = $currencyConversion;
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
       

        try {
            Mail::to($this->user->email)->send(new ConversionCurrencyMarkdown($this->user, $this->currencyConversion));
        } catch (\Exception $e) {
            Log::error('Exception caught: ' . $e->getMessage());
        }

    }
}
