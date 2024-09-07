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

class ProcessFileImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $uploadId;
    protected $filePath;
    protected $fileName;


    public function __construct($uploadId, $filePath, $fileName)
    {
        $this->uploadId = $uploadId;
        $this->filePath = $filePath;
        $this->fileName = $fileName;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            Log::info('Iniciando importação para o arquivo: ' . $this->fileName);

            // Importar o arquivo
            Excel::import(new FileImport($this->uploadId), $this->filePath);
//            $this->excel->import(new FileImport($upload->id), $filePath);

            Log::info('Importação concluída para o arquivo: ' . $this->filePath->getClientOriginalName());
        } catch (\Exception $e) {
            Log::error('Erro ao importar o arquivo: ' . $e->getMessage());
            throw $e;
        }
    }
}
