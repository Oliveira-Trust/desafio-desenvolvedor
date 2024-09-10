<?php

namespace App\Jobs;

use App\Imports\FileImport;
use App\Models\Upload;
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
//    public $queue = 'import'; // deu erro
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
        $this->removeFirstLine($this->filePath);
        try {
            $import = Excel::import(new FileImport($this->uploadId), $this->filePath);
//            dd($import);  // exibiu  -inputEncoding: "UTF-8"  fallbackEncoding: "CP1252"
//            $import = Excel::toCollection(true, $this->filePath);
//            dd($import);
             $upl = Upload::find($this->uploadId);
             $upl->finished = true;
             $upl->save();



        } catch (\Exception $e) {
            Log::error('Erro ao importar o arquivo: ' . $e->getMessage());
        }
    }

    function removeFirstLine($filePath) {
        $filePath = storage_path('app/' . $filePath);

        $lines = file($filePath, FILE_IGNORE_NEW_LINES);

        // Remove a primeira linha
        // if (strpos($lines[0], ';') !== false) {
        unset($lines[0]);
        // }

        // Recria o arquivo com a linha de cabeçalho correta
        file_put_contents($filePath, implode(PHP_EOL, $lines));

//        $lines = file($filePath, FILE_IGNORE_NEW_LINES);
//        dd($lines);

    }

}
