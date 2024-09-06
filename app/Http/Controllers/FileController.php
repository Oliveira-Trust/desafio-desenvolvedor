<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Imports\FileImport;
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
        $fileName = $file->getClientOriginalName();

        // Verificar se o arquivo já foi enviado
        if (Upload::where('file_name', $fileName)->exists())
            return response()->json(['message' => 'Arquivo enviado anteriormente.'], 400);

        // Salvar o arquivo
        $filePath = $file->store('files');

        // Criar registro de upload
        $upload = Upload::create([
            'file_name' => $fileName,
            'uploaded_at' => now()
        ]);

        // Importar e salvar o conteúdo do arquivo
        $this->excel->import(new FileImport($upload->id), $filePath);

        return response()->json(['message' => 'Arquivo carregado com sucesso.']);
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
}
