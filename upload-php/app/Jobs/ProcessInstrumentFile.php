<?php

namespace App\Jobs;

use App\Models\Upload;
use App\Services\InstrumentFileService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessInstrumentFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $uploadId;

    /**
     * Create a new job instance.
     */
    public function __construct($uploadId)
    {
        $this->uploadId = $uploadId;
    }

    /**
     * Execute the job.
     */
    public function handle(InstrumentFileService $service)
    {
        $upload = Upload::find($this->uploadId);

        if (!$upload) {
            return;
        }

        $upload->status = 'processing';
        $upload->save();

        try {
            $service->process($upload);
            $upload->status = 'completed';
        } catch (\Throwable $e) {
            $upload->status = 'failed';
        }

        $upload->save();
    }
}
