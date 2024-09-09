<?php

namespace App\Jobs;

use App\Models\FileContent;
use App\Models\Upload;
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
    protected $filePath;

    /**
     * Create a new job instance.
     */
    public function __construct($uploadId, $filePath, $fileName, $verifyMinutes = 5)
    {
        $this->uploadId = $uploadId;
        $this->fileName = $fileName;
        $this->filePath = $filePath;
        $this->verifyMinutes = $verifyMinutes;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
//        dump('ini');
        $reportPath = 'public/report_jobs/' . pathinfo($this->fileName, PATHINFO_FILENAME) . '.html';

//        $totalRows = $this->countTotalRows();
//        dump('total: '.$totalRows);

        // Create the initial report file
        $this->createReportFile($reportPath, 'Iniciando a importação de ' . $this->fileName . '.');

        while (true) {
            $rowsProcessed = $this->countProcessedRows();
//            dump('processado: '.$rowsProcessed);

            $upload = Upload::find($this->uploadId);
//            dump($upload);
//            dump('while');

            if ($upload->finished) {
                $this->updateReportFile($reportPath, 'Finalizado  com sucesso. ' . $rowsProcessed . ' registros processados');
                break;

            } else {
                $this->updateReportFile($reportPath, 'Processado ' . $rowsProcessed . ' registros');
            }

            sleep($this->verifyMinutes * 60);
//            sleep(30);
        }
    }

    protected function countTotalRows()
    {
        $spreadsheet = \Maatwebsite\Excel\Facades\Excel::toCollection(null, $this->filePath);
        // Ignorar a linha do cabeçalho
        return $spreadsheet->first()->count() - 2;
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
