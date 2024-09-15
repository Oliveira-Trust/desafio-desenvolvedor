<?php

namespace App\Jobs;

use App\Services\UploadService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UploadJob implements ShouldQueue

{
    use Queueable;

    /**
     * Número máximo de tentativas.
     */
    public $tries = 10;

    /**
     * Intervalo entre tentativas em segundos.
     */
    public $backoff = 30;

    /**
     * Tempo máximo de execução do job em segundos.
     */
    public $timeout = 120;

    /**
     * Caminho do arquivo para upload.
     */
    protected $filePath;

    /**
     * Create a new job instance.
     */
    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * Execute the job.
     */
    public function handle(UploadService $uploadService): void
    {
        try {
            $fullFilePath = storage_path('app/' . $this->filePath);

            // Verificar se o arquivo existe
            if (!file_exists($fullFilePath)) {
                Log::error('Arquivo não encontrado para upload', ['file' => $this->filePath]);
                return; // Finalizar o job para evitar tentativas desnecessárias
            }

            // Reconstruir o objeto UploadedFile usando o caminho
            $uploadedFile = new UploadedFile(
                $fullFilePath,
                basename($this->filePath),
                mime_content_type($fullFilePath),
                null,
                true // Indicar que o arquivo já existe no sistema de arquivos
            );

            // Passar o arquivo reconstruído para o serviço de upload
            $uploadService->uploadFile($uploadedFile);

            // Remover o arquivo após o upload
            Storage::delete($this->filePath);
        } catch (\Exception $e) {
            Log::error('Erro ao processar o job UploadJob', [
                'message' => $e->getMessage(),
                'file' => $this->filePath,
            ]);
        }
    }
}
