<?php

namespace App\Jobs;

use App\Mail\InstrumentImportFailed;
use App\Mail\InstrumentImportFinished;
use App\Models\UploadHistory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendEmailInstrumentsJob implements ShouldQueue
{
    use Queueable;

    public function __construct(public UploadHistory $history, public ?String $errorMessage)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $userEmail = $this->history->user->email;

        if($this->errorMessage) {
            Mail::to($userEmail)->send(new InstrumentImportFailed($this->history, $this->errorMessage));
            return;
        }
            
        Mail::to($userEmail)->send(new InstrumentImportFinished($this->history));

    }
}
