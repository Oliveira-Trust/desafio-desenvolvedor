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
        $mime = $file->getMimeType();
        $extension = strtolower($file->getClientOriginalExtension());
        
        if ($mime === 'text/plain' && $extension !== 'csv') {
            return response()->json(['error' => 'Apenas arquivos CSV e Excel são permitidos'], 422);
        }
        
        $hash = hash_file('sha256', $file->getRealPath());
        
        if (UploadedFile::where('file_hash', $hash)->exists()) {
            return response()->json(['error' => 'Arquivo já enviado'], 409);
        }
        
        $filePath = $file->storeAs('uploads', $file->getClientOriginalName());

        UploadedFile::create([
            'file_name'   => $file->getClientOriginalName(),
            'file_hash'   => $hash,
        ]);
        
        ProcessUploadedFile::dispatch(storage_path('app/private/'.$filePath), $extension, $hash);

        return response()->json(['message' => 'Upload realizado e enviado para processamento']);
    }

    public function history(Request $request)
    {
        $filename = $request->query('filename');
        $date = $request->query('date'); // yyyy-mm-dd

        if (!$filename && !$date) {
            return response()->json(['error' => 'É necessário informar pelo menos um dos parâmetros: filename ou date'], 422);
        }

        $query = UploadedFile::query();

        if ($filename) {
            // "buscar um envio especifico", logo, vamos buscar pelo nome exato do arquivo
            $query->where('file_name', '=', $filename);
        }   

        if ($date) {
            $query->whereDate('created_at', $date);
        }

        $files = $query->orderBy('created_at', 'desc')->get();

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

        if($TckrSymb && $RptDt) {
            // Não será paginado
            $produtos = ProductsList::where('TckrSymb', $TckrSymb)
                        ->where('RptDt', $RptDt)
                        ->get();

            if($produtos->isEmpty()) {
                return response()->json(['message' => 'Nenhum conteúdo encontrado'], 404);
            }

            return response()->json(['message' => 'Listagem de conteúdos específicos', 'data' => $produtos], 200);

        } else {
            if(empty($TckrSymb) && empty($RptDt)) {
                // Paginação implementada
                $produtos = ProductsList::paginate(20);
    
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
