<?php declare(strict_types=1);

namespace App\Jobs;

use App\Models\FileUpload;
use App\Services\FileProcessingService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Throwable;

class ProcessInstrumentFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Number of times the job may be attempted.
     * Large files take time; allow 3 retries with backoff.
     */
    public int $tries = 3;

    /**
     * Timeout in seconds – 30 min for very large files (~400k lines).
     */
    public int $timeout = 1800;

    public function __construct(
        private readonly string $fileUploadId,
        private readonly string $storedName,
    )
    {
    }

    public function handle(FileProcessingService $service): void
    {
        /** @var FileUpload $upload */
        $upload = FileUpload::findOrFail($this->fileUploadId);

        Log::info("[ProcessInstrumentFile] Starting", ['file' => $this->storedName]);

        $upload->markAsProcessing();

        $storagePath = Storage::disk('local')->path("uploads/$this->storedName");

        try {
            $service->process($upload, $storagePath);

            Log::info("[ProcessInstrumentFile] Completed", [
                'file' => $this->storedName,
                'records' => $upload->fresh()->total_records,
            ]);
        } catch (Throwable $e) {
            Log::error("[ProcessInstrumentFile] Failed", [
                'file' => $this->storedName,
                'error' => $e->getMessage(),
            ]);

            $upload->markAsFailed($e->getMessage());

            $this->fail($e);
        }
    }

    public function failed(Throwable $exception): void
    {
        Log::error("[ProcessInstrumentFile] Job failed permanently", [
            'file' => $this->storedName,
            'error' => $exception->getMessage(),
        ]);
    }
}
