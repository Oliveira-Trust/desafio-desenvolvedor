<?php

namespace App\Instrument\Jobs;

use App\FileUpload\Models\FileUpload;
use App\Instrument\Services\InstrumentService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessInstrumentFileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue,  SerializesModels;

    public int $timeout = 600;

    public int $tries = 3;

    public function __construct(private FileUpload $fileUpload) {}

    public function handle(InstrumentService $service): void
    {
        $this->fileUpload->refresh();
        $service->execute($this->fileUpload);
    }
}
