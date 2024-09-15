<?php

namespace App\Jobs;

use App\Models\Upload;
use App\Imports\FileContentImport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;
use Exception;

class ProcessFileUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $upload;
    protected $filePath;

    // Número máximo de tentativas
    public $tries = 5;

    // Tempo de espera entre as tentativas (em segundos)
    public $backoff = 10;

    /**
     * Cria uma nova instância do job.
     *
     * @param Upload $upload
     * @param string $filePath
     */
    public function __construct(Upload $upload, string $filePath)
    {
        $this->upload = $upload;
        $this->filePath = $filePath;
    }

    /**
     * Executa o job para processar o upload do arquivo.
     *
     * @return void
     */
    public function handle()
    {
        try {
            // Importa o conteúdo do arquivo usando a classe FileContentImport
            Excel::import(new FileContentImport($this->upload->id), $this->filePath);
            Log::info('Arquivo processado com sucesso: ' . $this->filePath);

            // Atualizar status do upload para indicar sucesso
            $this->upload->update(['status' => 'completed']);
        } catch (Exception $e) {
            // Log de erro em caso de falha na importação
            Log::error('Erro ao processar o arquivo ' . $this->filePath . ': ' . $e->getMessage());

            // Re-throw a exceção para que o job seja re-tentado se possível
            throw $e;
        }
    }

    /**
     * Ação a ser tomada caso o job falhe permanentemente.
     *
     * @param Exception $e
     * @return void
     */
    public function failed(Exception $e)
    {
        // Logar quando o job falha após todas as tentativas
        Log::critical('O job falhou permanentemente ao processar o arquivo ' . $this->filePath . ': ' . $e->getMessage());

        // Atualizar o status do upload para indicar falha
        $this->upload->update(['status' => 'failed']);
    }
}
