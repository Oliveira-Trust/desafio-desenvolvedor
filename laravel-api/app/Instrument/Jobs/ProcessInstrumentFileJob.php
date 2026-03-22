<?php

declare(strict_types=1);

namespace App\Instrument\Jobs;

use App\FileUpload\Models\FileUpload;
use App\Instrument\Services\InstrumentService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessInstrumentFileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue,  SerializesModels;

    public int $timeout = 600;

    public int $tries = 3;

    public function backoff(): array
    {
        return [0, 60, 300];
    }

    public function __construct(private FileUpload $fileUpload) {}

    public function handle(InstrumentService $service): void
    {
        $this->fileUpload->refresh();

        if ($this->fileUpload->status === 'done') {
            Log::channel('file_upload')->info('Job ignorado — arquivo já processado.', [
                'file_upload_id' => $this->fileUpload->id,
            ]);

            return;
        }

        $service->execute($this->fileUpload);
    }

    public function failed(\Throwable $exception): void
    {
        Log::channel('file_upload')->error('Job falhou permanentemente.', [
            'file_upload_id' => $this->fileUpload->id,
            'error' => $exception->getMessage(),
        ]);

        $this->fileUpload->update([
            'status' => 'failed',
            'error_message' => $exception->getMessage(),
        ]);
    }
}
