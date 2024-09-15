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
use League\Csv\Reader;
use League\Csv\Statement;

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
        //     'file' => 'required|mimes:csv,txt',
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

            if ($request->has('file_name') && $request->input('file_name') !== 'all') {
                $query->where('file_name', $request->input('file_name'));
            }

            if ($request->has('date') && $request->input('date') !== 'all') {
                $query->whereDate('created_at', $request->input('date'));
            }

            return $query->get();
        });

        return response()->json($history);
    }
    public function search(Request $request)
    {
        $filePath = 'uploads/tesd.csv'; // Caminho do arquivo CSV
        Log::info('Caminho do arquivo CSV: ' . Storage::path($filePath));

        $cacheKey = $this->cacheService->generateCacheKey('search', $request->all());

        return $this->cacheService->remember($cacheKey, function () use ($request, $filePath) {
            $csv = Reader::createFromPath(Storage::path($filePath), 'r');
            $csv->setDelimiter(';'); // Configura o delimitador do CSV
            $csv->setHeaderOffset(1); // Define a linha de cabeçalho (segunda linha)

            $stmt = (new Statement());

            // Filtra os dados com base nos parâmetros fornecidos
            if ($request->has('TckrSymb') && $request->has('RptDt')) {
                $stmt = $stmt->where(function ($record) use ($request) {
                    return isset($record['TckrSymb'], $record['RptDt']) &&
                           $record['TckrSymb'] === $request->input('TckrSymb') &&
                           $record['RptDt'] === $request->input('RptDt');
                });
            }

            $records = $stmt->process($csv);

            // Filtra registros válidos (ignora a linha "Status do Arquivo: Parcial")
            $filteredRecords = array_filter(iterator_to_array($records), function ($record) {
                return $record['RptDt'] !== 'Status do Arquivo: Parcial';
            });

            // Log dos registros lidos
            foreach ($filteredRecords as $record) {
                Log::info('Registro lido: ', $record);
            }

            // Paginação manual
            $perPage = 10;
            $page = $request->input('page', 1);
            $totalRecords = count($filteredRecords);
            $totalPages = ceil($totalRecords / $perPage);
            $offset = ($page - 1) * $perPage;
            $paginatedRecords = array_slice($filteredRecords, $offset, $perPage);

            // Construir URL da próxima página
            $nextPageUrl = $page < $totalPages ? $request->fullUrlWithQuery(['page' => $page + 1]) : null;

            return [
                'data' => array_map(function ($record) {
                    return [
                        'RptDt' => $record['RptDt'] ?? null,
                        'TckrSymb' => $record['TckrSymb'] ?? null,
                        'MktNm' => $record['MktNm'] ?? null,
                        'SctyCtgyNm' => $record['SctyCtgyNm'] ?? null,
                        'ISIN' => $record['ISIN'] ?? null,
                        'CrpnNm' => $record['CrpnNm'] ?? null,
                    ];
                }, $paginatedRecords),
                'pagination' => [
                    'total' => $totalRecords,
                    'per_page' => $perPage,
                    'current_page' => $page,
                    'total_pages' => $totalPages,
                    'next_page_url' => $nextPageUrl,
                ],
            ];
        });
    }
}
