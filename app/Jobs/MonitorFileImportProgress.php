<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MonitorFileImportProgress implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // rodar na fila monitor
    public $queue = 'monitor';

    protected $uploadId;
    protected $fileName;
    protected $verifyMinutes;

    /**
     * Create a new job instance.
     */
    public function __construct($uploadId, $fileName, $verifyMinutes = 1)
    {
        $this->uploadId = $uploadId;
        $this->fileName = $fileName;
        $this->verifyMinutes = $verifyMinutes;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $totalRows = $this->countTotalRows();
        $reportPath = 'public/report_jobs/' . pathinfo($this->fileName, PATHINFO_FILENAME) . '.html';

        // Create the initial report file
        $this->createReportFile($reportPath, 'Iniciando a importação de ' . $this->fileName . ' com ' . $totalRows . ' registros');

        while (true) {
            $rowsProcessed = $this->countProcessedRows();

            if ($rowsProcessed < $totalRows) {
                $this->updateReportFile($reportPath, 'Processado ' . $rowsProcessed . ' de ' . $totalRows . ' registros');
            } else {
                $this->updateReportFile($reportPath, 'Arquivo ' . $this->fileName . ' com ' . $totalRows . ' registros processados com sucesso');
                break;
            }

//            sleep($this->verifyMinutes * 60);
            sleep(20);
        }
    }

    protected function countTotalRows()
    {
        // This function should get the total rows from the file or a data source
        // For simplicity, let's assume it returns the total rows excluding headers
        return \App\Models\Upload::find($this->uploadId)->total_rows; // You need to have total rows stored somewhere
    }

    protected function countProcessedRows()
    {
        return FileContent::where('upload_id', $this->uploadId)->count();
    }

    protected function createReportFile($reportPath, $description)
    {
        $content = "<!DOCTYPE html><html lang='pt-BR'><body><table border='1'>";
        $content .= "<tr><th>Data e Hora</th><th>Descrição</th></tr>";
        $content .= "<tr><td>" . now()->format('d-m-Y H:i:s') . "</td><td>" . htmlspecialchars($description, ENT_QUOTES, 'UTF-8') . "</td></tr>";
        $content .= "</table></body></html>";

        Storage::put($reportPath, $content);
    }

    protected function updateReportFile($reportPath, $description)
    {
        if (Storage::exists($reportPath)) {
            $currentContent = Storage::get($reportPath);
            $newContent = "<tr><td>" . now()->format('d-m-Y H:i:s') . "</td><td>" . htmlspecialchars($description, ENT_QUOTES, 'UTF-8') . "</td></tr>";
            $updatedContent = str_replace('</table>', $newContent . '</table>', $currentContent);
            Storage::put($reportPath, $updatedContent);
        }
    }
}
