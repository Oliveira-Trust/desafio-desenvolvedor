<?php
namespace App\Http\Controllers;

use App\Services\FileService;
use App\Services\CsvService;
use App\Services\UploadService;
use App\Services\CacheService;
use Illuminate\Http\Request;
use App\Models\Upload;

class FileUploadController extends Controller
{
    protected $fileService;
    protected $csvService;
    protected $uploadService;
    protected $cacheService;

    public function __construct(FileService $fileService, CsvService $csvService, UploadService $uploadService, CacheService $cacheService)
    {
        $this->fileService = $fileService;
        $this->csvService = $csvService;
        $this->uploadService = $uploadService;
        $this->cacheService = $cacheService;
    }

    public function upload(Request $request)
    {
        ini_set('memory_limit', '1024M');
        set_time_limit(600);

        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);

        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();

        if (Upload::where('file_name', $fileName)->exists()) {
            return response()->json(['error' => 'Este arquivo já foi enviado.'], 400);
        }

        $filePath = $this->fileService->storeFile($file);
        $upload = $this->uploadService->storeUpload($fileName, $filePath);

        try {
            $this->uploadService->processFile($file, $upload->id);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao processar o arquivo: ' . $e->getMessage(),
            ], 500);
        }

        return response()->json(['message' => 'Upload realizado com sucesso.'], 201);
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
        // Aumentar o tempo máximo de execução e a memória disponível
        ini_set('max_execution_time', 300);
        ini_set('memory_limit', '1024M');

        // Caminho da pasta de uploads
        $directoryPath = storage_path('app/public/uploads/');

        $allRecords = [];

        try {
            // Listar todos os arquivos CSV na pasta
            $files = glob($directoryPath . '*.csv');

            foreach ($files as $filePath) {
                $csvContent = $this->csvService->readCsv($filePath);
                $filteredRecords = $this->csvService->filterRecords($csvContent, $request->all());

                $allRecords = array_merge($allRecords, $filteredRecords);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao buscar os registros: ' . $e->getMessage(),
            ], 500);
        }

        $paginatedResponse = $this->paginate($allRecords, $request->input('page', 1), 10);

        return response()->json($paginatedResponse);
    }

    private function paginate($items, $page = 1, $perPage = 10)
    {
        $total = count($items);
        $totalPages = ceil($total / $perPage);
        $offset = ($page - 1) * $perPage;
        $paginatedItems = array_slice($items, $offset, $perPage);

        return [
            'data' => $paginatedItems,
            'pagination' => [
                'total' => $total,
                'per_page' => $perPage,
                'current_page' => $page,
                'total_pages' => $totalPages,
                'next_page_url' => $page < $totalPages ? request()->fullUrlWithQuery(['page' => $page + 1]) : null,
            ],
        ];
    }
}
