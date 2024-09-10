<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Imports\FileImport;
use App\Jobs\MonitorFileImportProgress;
use App\Jobs\ProcessFileImport;
use App\Models\FileContent;
use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Excel;


class FileController extends Controller
{
    protected $excel;

    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
    }

    public function upload(FileRequest $request)
    {
        $file = $request->file('file');
//        $this->_detectFileEncoding($file);
        $fileName = $file->getClientOriginalName();

        // Verificar se o arquivo já foi enviado
        if (Upload::where('file_name', $fileName)->exists())
            return response()->json(['message' => 'Arquivo enviado anteriormente.'], 400);

        // Converte o arquivo para UTF-8
        $path = $file->getRealPath();
//        $this->convertToUtf8($path);

        // Salvar o arquivo
//        $filePath = $file->store('files');
        $filePath = $file->storeAs('files', $fileName);

        // Criar registro de upload
        $upload = Upload::create([
            'file_name' => $fileName,
            'uploaded_at' => now()
        ]);

        // Importar e salvar o conteúdo do arquivo
//        dd(mb_detect_encoding($filePath, mb_list_encodings(), true));
//        $this->excel->import(new FileImport($upload->id), $filePath); // uso total memória.

        // Cria job para processar o arquivo
        ProcessFileImport::dispatch($upload->id, $filePath, $fileName )->onQueue('import');
        MonitorFileImportProgress::dispatch($upload->id, $filePath, $fileName, 3)->onQueue('monitor');

        // rodar:
        // php artisan queue:work --queue=import
        // php artisan queue:work --queue=monitor

        $baseUrl=env('APP_URL');
        return response()
            ->json([
                'message' => "Arquivo carregado. Será processado em fila. Acompanhe em $baseUrl/storage/report_jobs/" . pathinfo($fileName, PATHINFO_FILENAME) . '.html'
            ]);
    }

    public function uploadHistory(Request $request)
    {
        $query = Upload::query();

        if ($request->has('file_name')) {
            $query->where('file_name', $request->input('file_name'));
        }

        if ($request->has('date')) {
            $query->whereDate('uploaded_at', $request->input('date'));
        }

        $uploads = $query->get();
        return response()->json($uploads);
    }

    public function searchContent(Request $request)
    {
        $query = FileContent::query();

        if ($request->has('tckr_symb')) {
            $query->where('tckr_symb', $request->input('tckr_symb'));
        }

        if ($request->has('rpt_dt')) {
            $query->whereDate('rpt_dt', $request->input('rpt_dt'));
        }

        $contents = $query->paginate(15);
        return response()->json($contents);
    }


    protected function countProcessedRows()
    {
        return \App\Models\FileContent::where('upload_id', $this->uploadId)->count();
    }

    private function convertToUtf8($filePath)
    {
        $content = file_get_contents($filePath);

        // Detect encoding and convert to UTF-8 if necessary
        $encoding = mb_detect_encoding($content, mb_list_encodings(), true);
        if ($encoding && $encoding !== 'UTF-8') {
            $content = mb_convert_encoding($content, 'UTF-8', $encoding);
            // Save the file with UTF-8 encoding
            file_put_contents($filePath, $content);
        }
    }

    function _detectFileEncoding($filepath) {
        // VALIDATE $filepath !!!
        $content = file_get_contents($filepath);

        // Detect encoding
        $encoding = mb_detect_encoding($content, mb_list_encodings(), true);

        dd($encoding); // Shows the detected encoding
    }
}
