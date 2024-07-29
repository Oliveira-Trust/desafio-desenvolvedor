<?php

namespace App\Jobs;

use App\Mail\QuotationMail;
use App\Models\Quotation;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendQuotationEmail implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public User $user,
        public Quotation $quotation
    )
    {}

    public function handle(): void
    {
        $user = User::findOrFail($this->user->id);

        $quotation = Quotation::findOrFail($this->quotation->id);

        Log::info('sending_email_to:', [$user->email]);

        Mail::to($this->user->email)->send(new QuotationMail($user, $quotation));
    }
}
