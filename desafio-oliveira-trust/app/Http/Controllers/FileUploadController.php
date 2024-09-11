<?php

namespace App\Http\Controllers;

use App\Models\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use League\Csv\Reader;

class FileUploadController extends Controller
{
    public function upload(Request $request)
    {
        // Define mensagens personalizadas
        $messages = [
            'files.required' => 'É necessário enviar pelo menos um arquivo.',
            'files.*.file' => 'O arquivo deve ser válido.',
            'files.max' => 'O arquivo :attribute não pode exceder 20MB.',
        ];

        $validator = Validator::make($request->all(), [
            'files' => 'required|max:20480',
            'files.*' => 'file'
        ], $messages);


        if($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 400);
        }

        $files = $request->file('files');

        foreach($files as $file){
            $hashname = md5_file($file->getRealPath());
            $existingFile = FileUpload::where('hash_name',$hashname)->first();

            if($existingFile){
                return response()->json(['error'=>'Arquivo já foi salvo.'], 400);
            }

            $filename = time() . '_' . $file->getClientOriginalName();
        
            $filePath = $file->storeAs('uploads', $filename);

            FileUpload::create([
                'original_name' => $file->getClientOriginalName(),
                'hash_name' => $hashname,
                'path' => $filePath,
                'size' => $file->getSize(),
                'mime_type' => $file->getMimeType()
            ]);
        }

        return response()->json(['message' => 'Arquivos salvos com sucesso.'], 200);
    }

    public function index(Request $request)
    {
        $fileName = $request->query('file_name');
        $date = $request->query('date');

        $query = FileUpload::query();
        
        if(!empty($fileName)){
            $query->where('original_name', 'like', "%{$fileName}%");
        }

        if(!empty($date)){
            $query->whereDate('created_at', $date);
        }

        $uploads = $query->get();

        if($uploads->isEmpty()){
            return response()->json(['error'=>'Nenhum arquivo encontrado.'], 404);
        }

        return response()->json(['uploads' => $uploads], 200);
    }

    public function search(Request $request)
    {
        $fileName = $request->query('file_name');
        $date = $request->query('date');
       
        $query = FileUpload::query();
                
        if(!empty($fileName)){
            $query->where('original_name', 'like', "%{$fileName}%");
        }

        if(!empty($date)){
            $query->whereDate('created_at', $date);
        }

        $upload = $query->first();

        if(!$upload){
            return response()->json(['error'=>'Nenhum arquivo encontrado.'], 404);
        }

        $filePath = $upload->path;
        
        $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);

        
        if ($fileExtension !== 'csv') {
            return response()->json([
                'file_name' => $upload->original_name,
                'message' => 'buscado'
            ], 200);
        }
  
        try {
            $filePath = $upload->path;
            $csv = Reader::createFromPath(Storage::path($filePath), 'r');

            $csv->setDelimiter(';'); // Defina o delimitador correto
            $csv->setHeaderOffset(0); // Define a primeira linha como cabeçalho

            // Obtenha os registros
            $records = $csv->getRecords();
            
            // Limpeza e organização dos registros
            $cleanedData = [];
            foreach ($records as $record) {

                $cleanedRecord = [
                    'Status do Arquivo' => $record['Status do Arquivo'] ?? '',
                    'RptDt' => $record['RptDt'] ?? '',
                    'TckrSymb' => $record['TckrSymb'] ?? '',
                    'Asst' => $record['Asst'] ?? '',
                    // Adicione outros campos conforme necessário
                ];

                
                // Adicione o registro limpo ao array de dados
                $cleanedData[] = $cleanedRecord;
            }
            
            return response()->json([
                'file_name' => $upload->original_name,
                'data' => $cleanedData
            ], 200);
    
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao processar o arquivo: ' . $e->getMessage()], 500);
        }
    }
}
