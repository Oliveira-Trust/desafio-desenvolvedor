<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        // 1) Verifica se o arquivo foi enviado
        if (!$request->hasFile('file')) {
            return response()->json([
                'error' => 'Nenhum arquivo foi enviado'
            ], 422);
        }

        // 2) Recupera o arquivo
        $file = $request->file('file');

        // 3) Valida extensão
        $extension = strtolower($file->getClientOriginalExtension());
        if (!in_array($extension, ['csv', 'xlsx'])) {
            return response()->json([
                'error' => 'Formato inválido. Envie CSV ou XLSX'
            ], 422);
        }

        // 4) Caminho do histórico (index.json)
        $indexPath = storage_path('app/private/uploads/index.json');

        // 5) Garante que a pasta existe
        if (!is_dir(dirname($indexPath))) {
            mkdir(dirname($indexPath), 0777, true);
        }

        // 6) Se o index não existir ou estiver vazio, inicializa com []
        if (!file_exists($indexPath) || trim(file_get_contents($indexPath)) === '') {
            file_put_contents($indexPath, '[]');
        }

        // 7) Lê o histórico
        $history = json_decode(file_get_contents($indexPath), true);
        if (!is_array($history)) {
            $history = [];
        }

        // 8) Calcula o hash do arquivo (regra para não repetir)
        $hash = hash_file('sha256', $file->getRealPath());

        // 9) Verifica duplicidade
        foreach ($history as $item) {
            if (($item['hash'] ?? null) === $hash) {
                return response()->json([
                    'error' => 'Este arquivo já foi enviado anteriormente'
                ], 409);
            }
        }

        // 10) Salva o arquivo na pasta private/uploads
        $storedPath = $file->store('private/uploads');

        // 11) Registra no histórico
        $history[] = [
            'original_name' => $file->getClientOriginalName(),
            'hash' => $hash,
            'stored_path' => $storedPath,
            'uploaded_at' => now()->toISOString(),
        ];

        // 12) Grava o histórico atualizado
        file_put_contents(
            $indexPath,
            json_encode($history, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
        );

        // 13) Retorna sucesso
        return response()->json([
            'message' => 'Upload realizado com sucesso',
            'stored_path' => $storedPath
        ], 201);
    }
}
