<?php

namespace App\Jobs;

use App\Http\Services\HeaderRow;
use App\Imports\FileDataImport;
use App\Models\File;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ProcessFile implements ShouldQueue {
    use Queueable;
    public string $fileId;

    /**
     * Create a new job instance.
     */
    public function __construct(string $fileId) {
        $this->fileId = $fileId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void {
        $file = File::find($this->fileId);
        if (!$file) {
            Log::error("Arquivo não encontrado no banco. Cancelando JOB");
            return;
        }

        $fullPath = storage_path('app/public/' . $file->path);

        $headingRow  = app()->make(HeaderRow::class)->detectHeaderRow($fullPath, $file->extension);
        if(is_null($headingRow)){
            $headingRow = 1;
        }

        Excel::queueImport(new FileDataImport($file->id, $headingRow), $fullPath);

        $file->update(['status' => 'processado']);
    }
}
