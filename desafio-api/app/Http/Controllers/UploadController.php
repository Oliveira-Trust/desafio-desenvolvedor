<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Upload;

class UploadController extends Controller
{
    public function index()
    {
        return view('upload');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xlsx|max:20480',
        ]);

        $file = $request->file('file');
        $maxSize = 17200; // Bloqueio para envios para arquivos com mais de 17 mil linhas

        if ($file->getSize() > $maxSize * 1024) {
            return response()->json(['error' => 'O arquivo excede o tamanho maximo permitido de 17,2MB'], 400);
        }

        $filename = $file->getClientOriginalName();

        if (Upload::where('filename', $filename)->exists()) {
            return response()->json(['error' => 'Arquivo ja enviado'], 400);
        }

        $path = $file->storeAs('uploads', $filename);

        try {
            $this->processFile($file);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao processar o arquivo: ' . $e->getMessage()], 500);
        }

        Upload::create([
            'filename' => $filename,
            'uploaded_at' => now(),
        ]);

        return response()->json(['message' => 'Upload realizado com sucesso'], 200);
    }

    protected function processFile($file)
    {
        $filePath = $file->getRealPath();
        $chunkSize = 1000;

        if (($handle = fopen($filePath, 'r')) !== FALSE) {
            $header = fgetcsv($handle);

            $row = 0;
            $chunk = [];

            while (($data = fgetcsv($handle)) !== FALSE) {
                $chunk[] = $data;
                $row++;

                if ($row % $chunkSize == 0) {
                    // Processa o chunk
                    $this->processChunk($chunk, $header);
                    $chunk = [];
                }
            }

            if (!empty($chunk)) {
                $this->processChunk($chunk, $header);
            }

            fclose($handle);
        } else {
            throw new \Exception('Erro ao abrir o arquivo.');
        }
    }

    protected function processChunk($chunk, $header)
    {
        foreach ($chunk as $data) {
            $mappedData = array_combine($header, $data);
        }
    }

    public function history(Request $request)
    {
        $uploads = Upload::query();

        if ($request->has('filename') && !empty($request->input('filename'))) {
            $uploads->where('filename', 'like', '%' . $request->input('filename') . '%');
        }

        if ($request->has('date') && !empty($request->input('date'))) {
            try {
                $date = \Carbon\Carbon::createFromFormat('Y-m-d', $request->input('date'))->format('Y-m-d');
                $uploads->whereDate('uploaded_at', $date);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Data inválida'], 400);
            }
        }

        $results = $uploads->get();

        return response()->json($results);
    }



    public function search(Request $request)
    {
        $tckrSymb = $request->input('TckrSymb');
        $rptDt = $request->input('RptDt');

        $files = Storage::files('uploads');
        if (empty($files)) {
            return response()->json(['error' => 'Nenhum arquivo encontrado'], 404);
        }

        $latestFile = collect($files)->sortByDesc(function ($file) {
            return Storage::lastModified($file);
        })->first();

        $filePath = Storage::path($latestFile);

        if (!file_exists($filePath)) {
            return response()->json(['error' => 'Arquivo nao encontrado'], 404);
        }


        $results = [];
        if (($handle = fopen($filePath, 'r')) !== FALSE) {
            $firstLine = fgetcsv($handle);
            $header = fgetcsv($handle);
            $columnIndices = array_flip($header);

            if (!isset($columnIndices['TckrSymb']) || !isset($columnIndices['RptDt'])) {
                fclose($handle);
                return response()->json(['error' => 'Colunas TckrSymb,RptDt nao encontradas no arquivo'], 400);
            }

            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                $matches = true;

                if (!empty($tckrSymb) && stripos($data[$columnIndices['TckrSymb']], $tckrSymb) === false) {
                    $matches = false;
                }

                if (!empty($rptDt) && stripos($data[$columnIndices['RptDt']], $rptDt) === false) {
                    $matches = false;
                }

                if ($matches) {
                    $results[] = [
                        'RptDt' => $data[$columnIndices['RptDt']],
                        'TckrSymb' => $data[$columnIndices['TckrSymb']],
                        'MktNm' => $data[$columnIndices['MktNm']] ?? null,
                        'SctyCtgyNm' => $data[$columnIndices['SctyCtgyNm']] ?? null,
                        'ISIN' => $data[$columnIndices['ISIN']] ?? null,
                        'CrpnNm' => $data[$columnIndices['CrpnNm']] ?? null,
                    ];
                }
            }
            fclose($handle);
        } else {
            return response()->json(['error' => 'Erro ao abrir o arquivo'], 500);
        }

        if (empty($tckrSymb) && empty($rptDt)) {
            $perPage = 10;
            $page = $request->input('page', 1);
            $paginatedResults = array_slice($results, ($page - 1) * $perPage, $perPage);
            return response()->json([
                'data' => $paginatedResults,
                'current_page' => $page,
                'per_page' => $perPage,
                'total' => count($results),
            ]);
        }

        if (empty($results)) {
            return response()->json(['message' => 'Nenhum resultado encontrado'], 404);
        }

        return response()->json($results);
    }



}
