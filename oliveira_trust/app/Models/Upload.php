<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class Upload extends Model
{
    protected $table = 'uploads';

    protected $fillable = [
        'file_name',
        'file_path',
    ];

    public static function lerArquivoPaginado($filePath, $page = 1, $perPage = 10, $filtros = [])
    {
        // Abrir o arquivo
        $file = fopen($filePath, 'r');
        if (!$file) {
            return ['error' => 'Não foi possível abrir o arquivo.'];
        }

        $dados = [];
        $header = null;
        $linhaAtual = 0;

        // Lê o arquivo linha por linha
        while (($linha = fgetcsv($file, 0, ";")) !== false) {
            $linhaAtual++;

            // Detectar codificação e converter para UTF-8
            $linha = array_map(function ($campo) {
                $encoding = mb_detect_encoding($campo, ['UTF-8', 'ISO-8859-1', 'Windows-1252'], true);
                return mb_convert_encoding($campo, 'UTF-8', $encoding ?: 'ISO-8859-1');
            }, $linha);

            // Pula linha 01
            if ($linhaAtual == 1) {
                continue;
            }
            if ($linhaAtual == 2) {
                $header = $linha;
                continue;
            }

            if ($header) {
                $dados[] = array_combine($header, $linha);
            }
        }

        fclose($file);

        // Filtros [TckrSymb] e [RptDt]
        if (!empty($filtros)) {
            $dados = array_filter($dados, function ($item) use ($filtros) {
                foreach ($filtros as $chave => $valor) {
                    if (isset($item[$chave]) && $item[$chave] !== $valor) {
                        return false;
                    }
                }
                return true;
            });
        }

        $collection = collect($dados);

        // paginator do Laravel
        $total = $collection->count();
        $items = $collection->slice(($page - 1) * $perPage, $perPage)->values();

        return new LengthAwarePaginator(
            $items,
            $total,
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );
    }
}
