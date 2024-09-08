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
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProcessFileImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $uploadId;
    protected $filePath;
    protected $fileName;
    protected $verifyMinutes;

    public function __construct($uploadId, $filePath, $fileName, $verifyMinutes = 3)
    {
        $this->uploadId = $uploadId;
        $this->filePath = $filePath;
        $this->fileName = $fileName;
        $this->verifyMinutes = $verifyMinutes;
    }

    public function handle()
    {
        $totalRows = $this->countTotalRows();
        $this->createReportFile('Iniciando a importação de ' . $this->fileName . ' com ' . $totalRows . ' linhas');

        // Processar o arquivo
        try {
            Excel::import(new FileImport($this->uploadId), $this->filePath);
        } catch (\Exception $e) {
            Log::error('Erro ao importar o arquivo: ' . $e->getMessage());
            $this->createReportFile('Erro ao importar o arquivo: ' . $e->getMessage());
            throw $e;
        }

        // Loop para verificar o progresso
        while (true) {
            $rowsProcessed = $this->countProcessedRows();

            // Atualizar o progresso do arquivo
            $this->updateReportFile('Processado ' . $rowsProcessed . ' de ' . $totalRows . ' linhas');

            // Verificar se todos os registros foram processados
            if ($rowsProcessed >= $totalRows) {
                // Adicionar a linha final ao relatório HTML
                $this->updateReportFile('Arquivo ' . $this->fileName . ' com ' . $totalRows . ' registros processados com sucesso');
                break;
            }

            // Aguardar antes de verificar novamente
            sleep($this->verifyMinutes * 60); // Aguarda o intervalo definido
        }
    }

    protected function countTotalRows()
    {
        $spreadsheet = Excel::toCollection(null, $this->filePath);
        // Ignorar a linha do cabeçalho
        return $spreadsheet->first()->count() - 1;
    }

    protected function countProcessedRows()
    {
        return \App\Models\FileContent::where('upload_id', $this->uploadId)->count();
    }

    protected function createReportFile($description)
    {
        $reportPath = 'public/report_jobs/' . pathinfo($this->fileName, PATHINFO_FILENAME) . '.html';
        $content = "<html><body><table border='1'>";
        $content .= "<tr><th>Data e Hora</th><th>Descrição</th></tr>";
        $content .= "<tr><td>" . now() . "</td><td>" . $description . "</td></tr>";
        $content .= "</table></body></html>";

        Storage::put($reportPath, $content);
    }

    protected function updateReportFile($description)
    {
        $reportPath = 'public/report_jobs/' . pathinfo($this->fileName, PATHINFO_FILENAME) . '.html';
        if (Storage::exists($reportPath)) {
            $currentContent = Storage::get($reportPath);
            $newContent = "<tr><td>" . now() . "</td><td>" . $description . "</td></tr>";
            $updatedContent = str_replace('</table>', $newContent . '</table>', $currentContent);
            Storage::put($reportPath, $updatedContent);
        }
    }
}
