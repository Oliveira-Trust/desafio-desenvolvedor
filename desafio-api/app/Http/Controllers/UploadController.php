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
            'file' => 'required|mimes:csv,xlsx|max:204800',
        ]);

        $file = $request->file('file');

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

        \Log::info('Recebendo arquivo', ['file' => $file->getClientOriginalName()]);

        return response()->json(['message' => 'Upload realizado com sucesso'], 200);
    }

    protected function processFile($file)
    {
        $filePath = $file->getRealPath();
        $chunkSize = 500;

        if (($handle = fopen($filePath, 'r')) !== FALSE) {
            $header = fgetcsv($handle);

            $secondLine = fgetcsv($handle);
            if (count($header) != count($secondLine)) {
                $header = $secondLine;
                $secondLine = fgetcsv($handle);
            } else {
                fseek($handle, -strlen(implode(',', $secondLine)) - 2, SEEK_CUR);
            }

            $row = 0;
            $chunk = [];

            while (($data = fgetcsv($handle)) !== FALSE) {
                if (count($data) == count($header)) {
                    $chunk[] = $data;
                    $row++;

                    if ($row % $chunkSize == 0) {

                        $this->processChunk($chunk, $header);
                        $chunk = [];
                    }
                } else {
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

        $perPage = 10;
        $page = $request->input('page', 1);
        $results = $uploads->paginate($perPage, ['*'], 'page', $page);

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

        $results = [];
        foreach ($files as $file) {
            $filePath = Storage::path($file);

            if (!file_exists($filePath)) {
                continue; // Pule para o próximo arquivo se este não existir
            }

            if (($handle = fopen($filePath, 'r')) !== FALSE) {
                fgetcsv($handle);

                $header = fgetcsv($handle);
                if ($header === FALSE) {
                    fclose($handle);
                    continue;
                }

                $columnIndices = array_flip($header);
                if (!isset($columnIndices['TckrSymb']) || !isset($columnIndices['RptDt'])) {
                    fclose($handle);
                    continue;
                }

                while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                    $matches = true;

                    if (!empty($tckrSymb) && !isset($data[$columnIndices['TckrSymb']]) || stripos($data[$columnIndices['TckrSymb']], $tckrSymb) === false) {
                        $matches = false;
                    }

                    if (!empty($rptDt) && !isset($data[$columnIndices['RptDt']]) || stripos($data[$columnIndices['RptDt']], $rptDt) === false) {
                        $matches = false;
                    }

                    if ($matches) {
                        $results[] = [
                            'RptDt' => $data[$columnIndices['RptDt']] ?? null,
                            'TckrSymb' => $data[$columnIndices['TckrSymb']] ?? null,
                            'MktNm' => $data[$columnIndices['MktNm']] ?? null,
                            'SctyCtgyNm' => $data[$columnIndices['SctyCtgyNm']] ?? null,
                            'ISIN' => $data[$columnIndices['ISIN']] ?? null,
                            'CrpnNm' => $data[$columnIndices['CrpnNm']] ?? null,
                        ];
                    }
                }
                fclose($handle);
            }
        }

        if (empty($results)) {
            return response()->json(['message' => 'Nenhum resultado encontrado'], 404);
        }

        if (empty($tckrSymb) && empty($rptDt)) {
            $perPage = 100;
            $page = $request->input('page', 1);
            $paginatedResults = array_slice($results, ($page - 1) * $perPage, $perPage);
            return response()->json([
                'data' => $paginatedResults,
                'current_page' => $page,
                'per_page' => $perPage,
                'total' => count($results),
            ]);
        }

        return response()->json($results);
    }


}
