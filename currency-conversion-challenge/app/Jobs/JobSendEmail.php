<?php

namespace App\Jobs;

use App\Mail\Email;
use App\Models\Conversion;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class JobSendEmail implements ShouldQueue
{
    use Queueable;

    protected $conversion;
    protected $userEmail;

    public function __construct(Conversion $conversion, $userEmail)
    {
        $this->conversion = $conversion;
        $this->userEmail = $userEmail;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->userEmail)
            ->later(now()->addMinute(), new Email($this->conversion));
    }
}
