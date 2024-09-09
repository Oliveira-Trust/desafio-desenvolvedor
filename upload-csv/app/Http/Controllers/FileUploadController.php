<?php

namespace App\Http\Controllers;

use App\Models\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
/**
 * @OA\Info(
 *     title="API de Upload de Arquivos",
 *     version="1.0.0"
 * )
 */
class FileUploadController
{
    protected $fileUploadModel;

    public function __construct(FileUpload $fileUploadModel)
    {
        $this->fileUploadModel = $fileUploadModel;
    }
  /**
     * @OA\Post(
     *     path="/api/file-upload",
     *     summary="Upload de Arquivo",
     *     description="Permite o envio de arquivos Excel (.xlsx, .xls) ou CSV (.csv).",
     *     tags={"File Upload"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="file",
     *                     description="Arquivo a ser enviado",
     *                     type="string",
     *                     format="binary"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Arquivo enviado com sucesso",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Arquivo enviado, processado e salvo com sucesso."),
     *             @OA\Property(property="file_hash", type="string", example="d41d8cd98f00b204e9800998ecf8427e")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Erro de validação",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Erro ao fazer upload do arquivo.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erro interno no servidor",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Erro ao processar o arquivo.")
     *         )
     *     )
     * )
     */
    public function fileUpload(Request $request)
    {
        try {

            $request->validate([
                'file' => 'required|mimes:xlsx,xls,csv,txt',
            ], [
                'file.mimes' => 'Apenas arquivos do tipo Excel (.xlsx, .xls) e CSV (.csv) são permitidos.',
            ]);


            if (!$request->hasFile('file')) {
                return response()->json(['error' => 'Nenhum arquivo enviado.'], 400);
            }

            $file = $request->file('file');
            $fileHash = md5_file($file->getRealPath());


            $existingFile = $this->fileUploadModel->findFileByHash($fileHash);
            if ($existingFile) {
                return response()->json(['error' => 'Arquivo já enviado anteriormente.', 'file_hash' => $fileHash], 409);
            }

            $path = $file->store('uploads');
            $fileUpload = [
                'file_name' => $file->getClientOriginalName(),
                'file_hash' => $fileHash,
                'path' => $path,
                'uploaded_at' => now()->toISOString()
            ];

            $insertedFile = $this->fileUploadModel->saveFileUpload($fileUpload);
            $fileId = (string)$insertedFile->getInsertedId();

            $this->processTxtToCsvAndSave($fileId);

            return response()->json(['message' => 'Arquivo enviado, processado e salvo com sucesso.', 'file_hash' => $fileHash], 201);

        } catch (ValidationException $e) {
            return response()->json($e->errors() , 400);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao fazer upload do arquivo.', 'message' => $e->getMessage()], 500);
        }
    }

    public function processTxtToCsvAndSave($fileId)
    {
        try {
            $fileData = $this->fileUploadModel->findFileById($fileId);

            if (!$fileData) {
                return response()->json(['error' => 'Arquivo não encontrado.'], 404);
            }

            $filePath = storage_path('app/' . $fileData['path']);

            if (!file_exists($filePath)) {
                return response()->json(['error' => 'Arquivo físico não encontrado no servidor.'], 404);
            }

            $fileContent = file_get_contents($filePath);
            $encoding = mb_detect_encoding($fileContent, ['UTF-8', 'ISO-8859-1', 'ISO-8859-15', 'Windows-1252', 'ASCII'], true);

            if ($encoding && $encoding !== 'UTF-8') {
                $fileContent = mb_convert_encoding($fileContent, 'UTF-8', $encoding);
            } elseif (!$encoding) {
                return response()->json(['error' => 'Erro ao detectar a codificação do arquivo.'], 500);
            }

            $lines = explode("\n", $fileContent);
            $csvData = [];

            if (strpos(trim($lines[0]), 'Status do Arquivo: Final') !== false) {
                unset($lines[0]);
                $lines = array_values($lines);
            }

            $header = [];
            if (count($lines) > 0) {
                $header = str_getcsv(trim($lines[0]), ';');
                $header = array_filter($header);
                unset($lines[0]);
            }

            foreach ($lines as $line) {
                if (trim($line) === '') {
                    continue;
                }

                $row = str_getcsv(trim($line), ';');

                if (count($row) > count($header)) {
                    $row = array_slice($row, 0, count($header));
                }

                if (count($row) < count($header)) {
                    $row = array_pad($row, count($header), '');
                }

                $rowData = array_combine($header, $row);
                $csvData[] = $rowData;
            }

            $batchSize = 300;
            $totalBatches = ceil(count($csvData) / $batchSize);

            for ($i = 0; $i < $totalBatches; $i++) {
                $batchData = array_slice($csvData, $i * $batchSize, $batchSize);
                $preparedBatchData = $this->prepareBatchData($batchData);

                $this->fileUploadModel->insertFileData($preparedBatchData);
            }

            return response()->json(['message' => 'Dados processados e salvos com sucesso na coleção file_data.'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao processar o arquivo.', 'message' => $e->getMessage()], 500);
        }
    }


    private function prepareBatchData($batchData)
    {
        $preparedBatchData = [];

        foreach ($batchData as $row) {
            $data = [
                'RptDt' => $row['RptDt'],
                'TckrSymb' => $row['TckrSymb'],
                'MktNm' => $row['MktNm'],
                'SctyCtgyNm' => $row['SctyCtgyNm'],
                'ISIN' => $row['ISIN'],
                'CrpnNm' => $row['CrpnNm'],
            ];
            $preparedBatchData[] = $data;
        }

        return $preparedBatchData;
    }
 /**
     * @OA\Get(
     *     path="/api/file-upload-data",
     *     summary="Buscar Todos os Arquivos",
     *     description="Retorna a lista de arquivos já enviados para o sistema.",
     *     tags={"File Upload"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de arquivos",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="string", example="60f5a6f8e1234b3a2c8a5"),
     *             @OA\Property(property="file_name", type="string", example="arquivo.csv"),
     *             @OA\Property(property="file_hash", type="string", example="d41d8cd98f00b204e9800998ecf8427e"),
     *             @OA\Property(property="path", type="string", example="uploads/arquivo.csv"),
     *             @OA\Property(property="uploaded_at", type="string", example="2024-09-08T12:34:56+00:00")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Nenhum arquivo encontrado",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Nenhum arquivo encontrado.")
     *         )
     *     )
     * )
     */
    public function fileUploadData()
    {
        try {
            $documents = $this->fileUploadModel->findAllFiles();

            if (empty($documents)) {
                return response()->json(['message' => 'Nenhum arquivo encontrado.'], 404);
            }

            $simplifiedDocuments = array_map(function($document) {
                return [
                    'id' => (string) $document['_id'],
                    'file_name' => $document['file_name'],
                    'file_hash' => $document['file_hash'],
                    'path' => $document['path'],
                    'uploaded_at' => $document['uploaded_at']
                ];
            }, $documents);

            return response()->json($simplifiedDocuments, 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar dados do arquivo.',
                'message' => $e->getMessage()
            ], 500);
        }
    }
     /**
     * @OA\Get(
     *     path="/api/find-file",
     *     summary="Histórico de Upload de Arquivo",
     *     description="Permite buscar um arquivo pelo nome ou pela data de upload.",
     *     tags={"File Upload"},
     *     @OA\Parameter(
     *         name="file_name",
     *         in="query",
     *         description="Nome do arquivo",
     *         required=false,
     *         @OA\Schema(type="string", example="InstrumentsConsolidatedFile_20240823.csv")
     *     ),
     *     @OA\Parameter(
     *         name="uploaded_at",
     *         in="query",
     *         description="Data de upload",
     *         required=false,
     *         @OA\Schema(type="string", format="date", example="2024-09-08")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Arquivo encontrado",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="string", example="60f5a6f8e1234b3a2c8a5"),
     *             @OA\Property(property="file_name", type="string", example="arquivo.csv"),
     *             @OA\Property(property="file_hash", type="string", example="d41d8cd98f00b204e9800998ecf8427e"),
     *             @OA\Property(property="path", type="string", example="uploads/arquivo.csv"),
     *             @OA\Property(property="uploaded_at", type="string", example="2024-09-08T12:34:56+00:00")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Nenhum arquivo encontrado",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Nenhum arquivo encontrado.")
     *         )
     *     )
     * )
     */
    public function findFile(Request $request)
    {
        try {
            $fileName = $request->input('file_name');
            $uploadedAt = $request->input('uploaded_at');

            if (!$fileName && !$uploadedAt) {
                return response()->json(['message' => 'Passe o nome ou a data de upload do arquivo.'], 400);
            }

            $filter = [];

            if ($fileName) {
                $filter['file_name'] = $fileName;
            }

            if ($uploadedAt) {
                $filter['uploaded_at'] = [
                    '$regex' => new \MongoDB\BSON\Regex('^' . preg_quote($uploadedAt), 'i')
                ];
            }

            $documents = $this->fileUploadModel->findFilesByCriteria($filter);

            if (empty($documents)) {
                return response()->json(['message' => 'Nenhum arquivo encontrado.'], 404);
            }

            $simplifiedDocuments = array_map(function($document) {
                return [
                    'id' => (string) $document['_id'],
                    'file_name' => $document['file_name'],
                    'file_hash' => $document['file_hash'],
                    'path' => $document['path'],
                    'uploaded_at' => $document['uploaded_at']
                ];
            }, $documents);

            return response()->json($simplifiedDocuments, 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar arquivo.',
                'message' => $e->getMessage()
            ], 500);
        }
    }
     /**
     * @OA\Get(
     *     path="/api/search-files",
     *     summary="Buscar Conteúdo do Arquivo",
     *     description="Permite buscar arquivos com filtros baseados em 'TckrSymb' e 'RptDt'.",
     *     tags={"File Upload"},
     *     @OA\Parameter(
     *         name="TckrSymb",
     *         in="query",
     *         description="Símbolo do Ticker",
     *         required=false,
     *         @OA\Schema(type="string", example="AAPL")
     *     ),
     *     @OA\Parameter(
     *         name="RptDt",
     *         in="query",
     *         description="Data do Relatório",
     *         required=false,
     *         @OA\Schema(type="string", format="date", example="2024-09-08")
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Número da página",
     *         required=false,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Número de itens por página",
     *         required=false,
     *         @OA\Schema(type="integer", example=20)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Dados encontrados",
     *         @OA\JsonContent(
     *             @OA\Property(property="files", type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="RptDt", type="string", example="2024-09-08"),
     *                     @OA\Property(property="TckrSymb", type="string", example="AAPL"),
     *                     @OA\Property(property="MktNm", type="string", example="NASDAQ"),
     *                     @OA\Property(property="SctyCtgyNm", type="string", example="Stock"),
     *                     @OA\Property(property="ISIN", type="string", example="US0378331005"),
     *                     @OA\Property(property="CrpnNm", type="string", example="Apple Inc.")
     *                 )
     *             ),
     *             @OA\Property(property="total", type="integer", example=100),
     *             @OA\Property(property="page", type="integer", example=1),
     *             @OA\Property(property="per_page", type="integer", example=20),
     *             @OA\Property(property="total_pages", type="integer", example=5)
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Não foram encontrados dados com os filtros passados",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Nenhum dado encontrado.")
     *         )
     *     )
     * )
     */
    public function searchFiles(Request $request)
    {
        try {
            $tckrSymb = $request->input('TckrSymb');
            $rptDt = $request->input('RptDt');
            $page = (int) $request->input('page', 1);
            $perPage = (int) $request->input('per_page', 20);

            $filter = [];

            if ($tckrSymb) {
                $filter['TckrSymb'] = $tckrSymb;
            }

            if ($rptDt) {
                $filter['RptDt'] = $rptDt;
            }

            $skip = ($page - 1) * $perPage;
            $searchResults = $this->fileUploadModel->searchFiles($filter, $skip, $perPage);

            if (empty($searchResults['documents'])) {
                return response()->json([
                    'message' => 'Nenhum dado encontrado.',
                    'total' => $searchResults['total'],
                    'page' => $page,
                    'per_page' => $perPage
                ], 404);
            }

            $formattedDocuments = array_map(function($doc) {
                return [
                    'RptDt' => $doc['RptDt'] ?? null,
                    'TckrSymb' => $doc['TckrSymb'] ?? null,
                    'MktNm' => $doc['MktNm'] ?? null,
                    'SctyCtgyNm' => $doc['SctyCtgyNm'] ?? null,
                    'ISIN' => $doc['ISIN'] ?? null,
                    'CrpnNm' => $doc['CrpnNm'] ?? null,
                ];
            }, $searchResults['documents']);

            return response()->json([
                'files' => $formattedDocuments,
                'total' => $searchResults['total'],
                'page' => $page,
                'per_page' => $perPage,
                'total_pages' => ceil($searchResults['total'] / $perPage)
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao buscar arquivos.', 'message' => $e->getMessage()], 500);
        }
    }
}
