<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GetFileController extends Controller
{
    public function index(Request $request)
    {
        $tckr = $request->query('TckrSymb');
        $rptDt = $request->query('RptDt');

        $page = max(1, (int) $request->query('page', 1));
        $perPage = min(100, max(1, (int) $request->query('per_page', 20)));

        // Regra: para busca filtrada, exigir ambos os parâmetros
        if (($tckr && !$rptDt) || (!$tckr && $rptDt)) {
            return response()->json([
                'error' => 'Para busca filtrada, envie ambos os parâmetros: TckrSymb e RptDt'
            ], 422);
        }

        // 1) Pega o arquivo mais recente do histórico
        $indexPath = storage_path('app/private/uploads/index.json');
        if (!file_exists($indexPath) || trim(file_get_contents($indexPath)) === '') {
            return response()->json(['error' => 'Nenhum upload encontrado'], 404);
        }

        $history = json_decode(file_get_contents($indexPath), true);
        if (!is_array($history) || count($history) === 0) {
            return response()->json(['error' => 'Nenhum upload encontrado'], 404);
        }

        usort($history, fn ($a, $b) => strcmp($b['uploaded_at'] ?? '', $a['uploaded_at'] ?? ''));
        $latest = $history[0];

        $storedPath = $latest['stored_path'] ?? null;
        if (!$storedPath) {
            return response()->json(['error' => 'Upload inválido no histórico'], 500);
        }

        $fullPath = storage_path('app/' . $storedPath);
        if (!file_exists($fullPath)) {
            return response()->json(['error' => 'Arquivo não encontrado no storage'], 404);
        }

        // 2) Abre CSV e detecta delimitador
        $handle = fopen($fullPath, 'r');
        if (!$handle) {
            return response()->json(['error' => 'Não foi possível abrir o arquivo'], 500);
        }

        $delimiter = ';';
        $header = fgetcsv($handle, 0, $delimiter);

        if (!$header || count($header) < 2) {
            rewind($handle);
            $delimiter = ',';
            $header = fgetcsv($handle, 0, $delimiter);
        }

        if (!$header || count($header) < 2) {
            fclose($handle);
            return response()->json(['error' => 'Cabeçalho CSV inválido'], 422);
        }

        $colIndex = array_flip($header);

        // 3) Valida colunas obrigatórias (as do retorno esperado)
        $required = ['RptDt', 'TckrSymb', 'MktNm', 'SctyCtgyNm', 'ISIN', 'CrpnNm'];
        foreach ($required as $col) {
            if (!isset($colIndex[$col])) {
                fclose($handle);
                return response()->json(['error' => "Coluna obrigatória ausente: {$col}"], 422);
            }
        }

        // 4) Leitura do arquivo
        // - Se vier filtro (tckr+rptDt): retorna os registros filtrados (lista)
        // - Se não vier filtro: retorna paginado (sem carregar tudo na memória)
        $data = [];
        $total = 0;

        $offset = ($page - 1) * $perPage;
        $collected = 0;

        while (($row = fgetcsv($handle, 0, $delimiter)) !== false) {
            if (count($row) < count($header)) {
                continue;
            }

            $item = [
                'RptDt' => $row[$colIndex['RptDt']] ?? null,
                'TckrSymb' => $row[$colIndex['TckrSymb']] ?? null,
                'MktNm' => $row[$colIndex['MktNm']] ?? null,
                'SctyCtgyNm' => $row[$colIndex['SctyCtgyNm']] ?? null,
                'ISIN' => $row[$colIndex['ISIN']] ?? null,
                'CrpnNm' => $row[$colIndex['CrpnNm']] ?? null,
            ];

            // Caso filtrado
            if ($tckr && $rptDt) {
                if ($item['TckrSymb'] === $tckr && $item['RptDt'] === $rptDt) {
                    $data[] = $item;
                }
                continue;
            }

            // Caso sem filtro: paginação
            $total++;

            if ($total <= $offset) {
                continue;
            }

            if ($collected < $perPage) {
                $data[] = $item;
                $collected++;
            }

            // Não dá pra "break" aqui porque ainda precisamos contar $total
            // (para informar total correto). Mantemos simples e correto.
        }

        fclose($handle);

        // 5) Retornos
        if ($tckr && $rptDt) {
            return response()->json([
                'data' => $data,
                'total' => count($data),
            ]);
        }

        return response()->json([
            'data' => $data,
            'page' => $page,
            'per_page' => $perPage,
            'total' => $total,
        ]);
    }
}
