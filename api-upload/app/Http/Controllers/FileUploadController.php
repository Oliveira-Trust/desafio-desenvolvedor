<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use App\Models\FileContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\FileContentImport;
use App\Services\CacheService;

class FileUploadController extends Controller
{
    protected $cacheService;

    public function __construct(CacheService $cacheService)
    {
        $this->cacheService = $cacheService;
    }

    public function upload(Request $request)
    {
        // Aumentar o limite de memória e o tempo máximo de execução
        ini_set('memory_limit', '1024M'); // Aumentado para 1GB
        set_time_limit(600); // Aumentado para 10 minutos

        // Validação do arquivo
        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);

        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();

        // Log do tipo MIME do arquivo
        Log::info('Tipo MIME do arquivo: ' . $file->getMimeType());

        // Verifica se o arquivo já foi enviado
        if (Upload::where('file_name', $fileName)->exists()) {
            return response()->json(['error' => 'Este arquivo já foi enviado.'], 400);
        }

        // Armazena o arquivo
        $filePath = $file->storeAs('uploads', $fileName, 'public');

        // Salva no banco de dados
        $upload = Upload::create([
            'file_name' => $fileName,
            'file_path' => '/storage/' . $filePath,
        ]);

        // Processa e salva o conteúdo do arquivo
        try {
            Excel::import(new FileContentImport($upload->id), $file);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao processar o arquivo: ' . $e->getMessage(),
            ], 500);
        }

        return response()->json(['message' => 'Upload realizado com sucesso.'], 201);
    }

    public function store(Request $request)
    {
        // Validação do arquivo
        // $request->validate([
        //     'file' => 'required|mimes:csv,txt|max:2048',
        // ]);

        // Obter o arquivo enviado
        $file = $request->file('file');

        // Gerar um nome único para o arquivo
        $fileName = time() . '_' . $file->getClientOriginalName();

        // Salvar o arquivo no diretório 'uploads'
        $filePath = $file->storeAs('uploads', $fileName, 'public');

        // Salvar informações do upload no banco de dados
        $upload = Upload::create([
            'file_name' => $fileName,
            'file_path' => '/storage/' . $filePath,
        ]);

        // Importar os dados do arquivo CSV para a tabela 'file_contents'
        Excel::import(new FileContentImport($upload->id), $file);

        return response()->json([
            'success' => true,
            'message' => 'Arquivo processado e dados salvos com sucesso.',
        ]);
    }

    public function history(Request $request)
    {
        $params = [
            'file_name' => $request->input('file_name', 'all'),
            'date' => $request->input('date', 'all')
        ];
        $cacheKey = $this->cacheService->generateCacheKey('history', $params);

        $history = $this->cacheService->remember($cacheKey, function () use ($request) {
            $query = Upload::query();

            if ($request->has('file_name')) {
                $query->where('file_name', $request->input('file_name'));
            }

            if ($request->has('date')) {
                $query->whereDate('created_at', $request->input('date'));
            }

            return $query->get();
        });

        return response()->json($history);
    }

    public function search(Request $request)
    {
        $params = [
            'TckrSymb' => $request->input('TckrSymb', 'all'),
            'RptDt' => $request->input('RptDt', 'all')
        ];
        $cacheKey = $this->cacheService->generateCacheKey('search', $params);

        $searchResults = $this->cacheService->remember($cacheKey, function () use ($request) {
            $query = FileContent::query();

            if ($request->has('TckrSymb')) {
                $query->where('TckrSymb', $request->input('TckrSymb'));
            }

            if ($request->has('RptDt')) {
                $query->where('RptDt', $request->input('RptDt'));
            }

            // Seleciona apenas os campos necessários
            $query->select('RptDt', 'TckrSymb', 'MktNm', 'SctyCtgyNm', 'ISIN', 'CrpnNm');

            return $query->paginate(10);
        });

        return response()->json($searchResults);
    }
}
