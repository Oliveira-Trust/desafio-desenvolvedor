<?php

namespace App\Jobs;

use App\Services\InstrumentService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessInstrumentImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    protected $filePath;
    public $timeout = 1800;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    public function handle(InstrumentService $service)
    {
        try {
            $service->importFromCsv($this->filePath);
            unlink($this->filePath);
        } catch (\Exception $e) {
            Log::error("Erro ao importar CSV: " . $e->getMessage());
            throw $e;
        }
    }
}
