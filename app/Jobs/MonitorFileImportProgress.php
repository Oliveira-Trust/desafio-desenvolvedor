<?php

namespace App\Jobs;

use App\Models\FileContent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class MonitorFileImportProgress implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // rodar na fila monitor
//    public $queue = 'monitor'; // deu erro

    protected $uploadId;
    protected $fileName;
    protected $verifyMinutes;

    /**
     * Create a new job instance.
     */
    public function __construct($uploadId, $fileName, $totalRows, $verifyMinutes = 1)
    {
        $this->uploadId = $uploadId;
        $this->fileName = $fileName;
        $this->verifyMinutes = $verifyMinutes;
        $this->totalRows = $totalRows;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $reportPath = 'public/report_jobs/' . pathinfo($this->fileName, PATHINFO_FILENAME) . '.html';

        // Create the initial report file
        $this->createReportFile($reportPath, 'Iniciando a importação de ' . $this->fileName . ' com ' . $this->totalRows . ' registros');

        while (true) {
            $rowsProcessed = $this->countProcessedRows();

            if ($rowsProcessed < $this->totalRows) {
                $this->updateReportFile($reportPath, 'Processado ' . $rowsProcessed . ' de ' . $this->totalRows . ' registros');
            } else {
                $this->updateReportFile($reportPath, 'Arquivo ' . $this->fileName . ' com ' . $this->totalRows . ' registros processados com sucesso');
                break;
            }

//            sleep($this->verifyMinutes * 60);
            sleep(5);
        }
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
