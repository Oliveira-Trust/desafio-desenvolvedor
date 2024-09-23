<?php

namespace App\Services\Documento;

use App\Models\Arquivo;
use DateTime;
use Illuminate\Http\Request;

class HistoricoArquivoService 
{
    public function historico(Request $request)
    {
        $nome  = $request->query('nome');
        $data = $request->query('data');
        $porPagina = $request->query('per_page', 15); // Número de itens por página (default 15)
        $pagina = $request->query('page', 1); // Página atual (default 1)

        $consulta = Arquivo::query();

        if ($nome) {
                $consulta->where('nome', 'like', '%'. $nome .'%');
        }

        if ($data) {
                try {
                        $data = new DateTime($data);
                        $consulta ->whereDate('created_at',  $data->format('Y-m-d'));
                } catch(\Exception $e) {
                        return response()->json(['error' => 'Data inválida.'], 400);
                }
        }
        $arquivos = $consulta->paginate($porPagina, ['*'], 'pagina', $pagina);

        return $arquivos;
    }
}