<?php

namespace App\Jobs;

use App\Imports\FileImport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProcessFileImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // radar na fila import
    public $queue = 'import';
    protected $uploadId;
    protected $filePath;
    protected $fileName;

    public function __construct($uploadId, $filePath, $fileName)
    {
        $this->uploadId = $uploadId;
        $this->filePath = $filePath;
        $this->fileName = $fileName;
    }

    public function handle()
    {
        try {
            Excel::import(new FileImport($this->uploadId), $this->filePath);
        } catch (\Exception $e) {
            Log::error('Erro ao importar o arquivo: ' . $e->getMessage());
        }
    }
}
