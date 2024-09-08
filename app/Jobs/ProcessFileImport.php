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
        $this->createReportFile('Iniciando a importação de ' . $this->fileName . ' com ' . $this->countTotalRows() . ' linhas');

        $rowsProcessed = 0;
        $startTime = Carbon::now();
        $endTime = $startTime->copy()->addMinutes($this->verifyMinutes);

        while (true) {
            try {
                Excel::import(new FileImport($this->uploadId), $this->filePath);


                $rowsProcessed = $this->countProcessedRows();
                $this->updateReportFile('Processado ' . $rowsProcessed . ' de ' . $this->countTotalRows() . ' linhas');

                
                if (Carbon::now()->greaterThanOrEqualTo($endTime)) {
                    $endTime = Carbon::now()->addMinutes($this->verifyMinutes);
                    $rowsProcessed = $this->countProcessedRows();
                    $this->updateReportFile('Processado ' . $rowsProcessed . ' de ' . $this->countTotalRows() . ' linhas');
                }
            } catch (\Exception $e) {
                Log::error('Erro ao importar o arquivo: ' . $e->getMessage());
                $this->createReportFile('Erro ao importar o arquivo: ' . $e->getMessage());
                throw $e;
            }
        }

        $this->updateReportFile('Arquivo ' . $this->fileName . ' com ' . $this->countTotalRows() . ' registros processados com sucesso');
    }

    protected function countTotalRows()
    {
        $spreadsheet = Excel::toCollection(null, $this->filePath);
        return $spreadsheet->first()->count();
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
