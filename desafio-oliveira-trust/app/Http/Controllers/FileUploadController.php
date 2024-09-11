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
        // Define mensagens personalizadas de validação
        $messages = [
            'files.required' => 'É necessário enviar pelo menos um arquivo.',
            'files.*.file' => 'O arquivo deve ser válido.',
            'files.max' => 'O arquivo :attribute não pode exceder 20MB.',
        ];

        // Valida os dados recebidos e retorna um erro caso haja algum problema
        $validator = Validator::make($request->all(), [
            'files' => 'required|max:20480',
            'files.*' => 'file'
        ], $messages);

        if($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 400);
        }

        $files = $request->file('files');

        // Percorre o array de arquivos
        foreach($files as $file){
            $hashname = md5_file($file->getRealPath());
            $existingFile = FileUpload::where('hash_name',$hashname)->first();

            if($existingFile){
                return response()->json(['error'=>'Arquivo já foi salvo.'], 400);
            }

            // Nomeia o arquivo
            $filename = time() . '_' . $file->getClientOriginalName();
        
            // Salva o arquivo no storage
            $filePath = $file->storeAs('uploads', $filename);

            // Salva as informações no banco de dados
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
        // Recebe os parâmetros de busca
        $fileName = $request->query('file_name');
        $date = $request->query('date');

        // Inicializa a query na model FileUpload
        $query = FileUpload::query();
        
        // Verifica se existe o arquivo no banco de dados
        if(!empty($fileName)){
            $query->where('original_name', 'like', "%{$fileName}%");
        }

        // Verifica se existe a data no banco de dados
        if(!empty($date)){
            $query->whereDate('created_at', $date);
        }

        // Executa a query e retorna os resultados
        $uploads = $query->get();

        // Verifica se há resultados
        if($uploads->isEmpty()){
            return response()->json(['error'=>'Nenhum arquivo encontrado.'], 404);
        }

        return response()->json(['uploads' => $uploads], 200);
    }

    public function search(Request $request)
    {
        // Recebe os parâmetros de busca
        $fileName = $request->query('file_name');
        $date = $request->query('date');
       
        // Inicializa a query na model FileUpload
        $query = FileUpload::query();
                
        // Verifica se existe o arquivo no banco de dados
        if(!empty($fileName)){
            $query->where('original_name', 'like', "%{$fileName}%");
        }

        // Verifica se existe a data no banco de dados
        if(!empty($date)){
            $query->whereDate('created_at', $date);
        }

        // Executa a query e retorna o primeiro upload buscado
        $upload = $query->first();

        // Verifica se há upload
        if(!$upload){
            return response()->json(['error'=>'Nenhum arquivo encontrado.'], 404);
        }

        // Acessa o path do upload
        $filePath = $upload->path;
        
        // Extrai a infrmação da extensão do arquivo
        $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);

        // Verifica se o arquivo não é do tipo 'csv'
        if ($fileExtension !== 'csv') {
            return response()->json([
                'file_name' => $upload->original_name,
                'message' => 'Buscado com sucesso'
            ], 200);
        }
  
        // Confirmado que é um arquivo csv, é feito o processo de try catch para ler o arquivo
        try {
            // Acessa o path do upload
            $filePath = $upload->path;
            
            // Lê o arquivo csv usando a biblioteca League\Csv\Reader
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
                ];
                
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
