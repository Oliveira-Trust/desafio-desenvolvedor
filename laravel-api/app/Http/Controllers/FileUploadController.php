<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use App\Models\UploadedFile;
use App\Models\ProductsList;
use App\Jobs\ProcessUploadedFile;

class FileUploadController extends Controller
{

    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimetypes:text/plain,text/csv,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        $mime = $file->getMimeType();
        $extension = strtolower($file->getClientOriginalExtension());
        
        if ($mime === 'text/plain' && $extension !== 'csv') {
            return response()->json(['error' => 'Apenas arquivos CSV e Excel são permitidos'], 422);
        }
        
        $hash = hash_file('sha256', $file->getRealPath());
        
        if (UploadedFile::where('file_hash', $hash)->exists()) {
            return response()->json(['error' => 'Arquivo já enviado'], 409);
        }

        $filePath = $file->storeAs('uploads', $filename);

        UploadedFile::create([
            'file_name'   => $filename,
            'file_hash'   => $hash,
        ]);
        
        ProcessUploadedFile::dispatch(storage_path('app/private/'.$filePath), $extension, $hash);

        // Limpa cache por conta de novas entradas
        Cache::flush();

        return response()->json(['message' => 'Upload realizado e enviado para processamento']);
    }

    public function history(Request $request)
    {
        $filename = $request->query('filename');
        $date = $request->query('date'); // yyyy-mm-dd

        if (!$filename && !$date) {
            return response()->json(['error' => 'É necessário informar pelo menos um dos parâmetros: filename ou date'], 422);
        }

        $cacheKey = 'history:' . ($filename ?? 'any') . ':' . ($date ?? 'any');

        // 600 = 10 minutos
        $files = Cache::remember($cacheKey, 600, function () use ($filename, $date) {
            return UploadedFile::query()
                // "buscar um envio especifico", logo, vamos buscar pelo nome exato do arquivo
                ->when($filename, fn($query) => $query->where('file_name', $filename))
                ->when($date, fn($query) => $query->whereDate('created_at', $date))
                ->latest('created_at')
                ->get();
        });

        if ($files->isEmpty()) {
            return response()->json(['message' => 'Nenhum histórico de uploads encontrado'], 404);
        }

        return response()->json([
            'message' => 'Histórico de uploads',
            'filters' => [
                'filename' => $filename,
                'date' => $date,
            ],
            'data' => $files
        ]);
    }

    public function fileContents(Request $request) 
    {
        $TckrSymb = $request->query('TckrSymb');
        $RptDt = $request->query('RptDt');

        $cacheKey = 'fileContents:' . ($TckrSymb ?? 'any') . ':' . ($RptDt ?? 'any');

        if($TckrSymb && $RptDt) {
            // Não será paginado
            // 600 = 10 minutos
            $produtos = Cache::remember($cacheKey, 600, function () use ($TckrSymb, $RptDt) {
                return ProductsList::where('TckrSymb', $TckrSymb)
                            ->where('RptDt', $RptDt)
                            ->get();
            });

            if($produtos->isEmpty()) {
                return response()->json(['message' => 'Nenhum conteúdo encontrado'], 404);
            }

            return response()->json(['message' => 'Listagem de conteúdos específicos', 'data' => $produtos], 200);

        } else {
            if(empty($TckrSymb) && empty($RptDt)) {
                // Paginação implementada
                // 600 = 10 minutos
                $produtos = Cache::remember($cacheKey, 600, function () {
                    return ProductsList::paginate(20);
                });
    
                if($produtos->isEmpty()) {
                    return response()->json(['message' => 'Nenhum conteúdo encontrado'], 404);
                }
    
                $response = array_merge(
                    ['message' => 'Listagem de conteúdos paginada'],
                    $produtos->toArray(),
                );
    
                return response()->json($response, 200);

            } else {
                return response()->json(['error' => 'É necessário informar os 2 parâmetros: TckrSymb e RptDt; Para busca precisa'], 422);
            }
        }
    }
}
