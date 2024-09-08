<?php

namespace App\Http\Controllers;

use App\Models\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class FileUploadController
{
    protected $fileUploadModel;

    public function __construct(FileUpload $fileUploadModel)
    {
        $this->fileUploadModel = $fileUploadModel;
    }

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

    public function fileUploadData()
    {
        try {
            $documents = $this->fileUploadModel->findAllFiles();

            if (empty($documents)) {
                return response()->json(['message' => 'Nenhum arquivo encontrado.'], 404);
            }

            return response()->json(['files' => $documents], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao buscar dados do arquivo.', 'message' => $e->getMessage()], 500);
        }
    }

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

            return response()->json(['files' => $documents], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao buscar arquivo.', 'message' => $e->getMessage()], 500);
        }
    }

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
                    'message' => 'Nenhum arquivo encontrado.',
                    'total' => $searchResults['total'],
                    'page' => $page,
                    'per_page' => $perPage
                ], 404);
            }

            return response()->json([
                'files' => $searchResults['documents'],
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
