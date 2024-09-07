<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Upload;

class UploadController extends Controller
{
    // Endpoint para fazer o upload do arquivo
    public function uploadFile(Request $request)
    {
        // Validação do arquivo
        $request->validate([
            'file' => 'required|file|mimes:csv,txt|max:2048', // Limita o tamanho e o tipo do arquivo
        ]);

        // Obtém o arquivo
        $file = $request->file('file');

        // Calcula o hash do arquivo
        $fileHash = md5_file($file->getRealPath());

        // Verifica se o hash já existe no banco de dados
        if (Upload::where('file_hash', $fileHash)->exists()) {
            return response()->json([
                'message' => 'Este arquivo já foi enviado.'
            ], 409); // Retorna um erro 409 (Conflito) se o arquivo já foi enviado
        }

        // Gera um nome único para o arquivo
        $fileName = time() . '_' . $file->getClientOriginalName();

        // Armazena o arquivo no sistema de arquivos
        $filePath = $file->storeAs('uploads', $fileName);

        // Salva o hash e o nome do arquivo no banco de dados
        Upload::create([
            'file_name' => $fileName,
            'file_path' => $filePath,
            'file_hash' => $fileHash,
        ]);

        return response()->json([
            'message' => 'Upload realizado com sucesso!',
            'file_name' => $fileName,
            'file_path' => $filePath,
        ], 201); // Retorna uma resposta de sucesso 201 (Criado)
    }

    // Endpoint para listar o histórico de uploads filtrado por nome e/ou data
    public function uploadHistory(Request $request)
    {
        $query = Upload::query();

        if ($request->has('file_name')) {
            $query->where('file_name', 'like', '%' . $request->input('file_name') . '%');
        }

        if ($request->has('date')) {
            $query->whereDate('created_at', $request->input('date'));
        }

        $uploads = $query->get(['file_name', 'file_path', 'created_at']);

        return response()->json($uploads, 200);
    }

    // Endpoint para buscar o conteúdo do arquivo por referência e data
    public function searchFileContent(Request $request)
    {
        $query = Upload::query();

        if ($request->has('file_name')) {
            $query->where('file_name', 'like', '%' . $request->input('file_name') . '%');
        }

        if ($request->has('date')) {
            $query->whereDate('created_at', $request->input('date'));
        }

        $upload = $query->first();

        if (!$upload) {
            return response()->json([
                'message' => 'Arquivo não encontrado.'
            ], 404); // Retorna um erro 404 se o arquivo não for encontrado
        }

        // Lê o conteúdo do arquivo
        $fileContent = Storage::get($upload->file_path);

        return response()->json([
            'file_name' => $upload->file_name,
            'content' => $fileContent
        ], 200); // Retorna o conteúdo do arquivo
    }
}
