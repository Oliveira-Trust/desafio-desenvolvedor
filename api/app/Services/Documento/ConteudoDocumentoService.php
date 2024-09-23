<?php

namespace App\Services\Documento;

use App\Models\Documento;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class ConteudoDocumentoService 
{
    public function filtro(Request $request)
      {
            $porPagina = $request->query('per_page', 100); // Número de itens por página (default 15)
            $pagina = $request->query('page', 1); // Página atual (default 1)

            $parametros = $request->only([
                'RptDt',
                'TckrSymb',
                'MktNm',
                'SctyCtgyNm',
                'ISIN',
                'CrpnNm',
                'SgmtNm'
            ]);
            $consulta = Documento::query();
            foreach ($parametros as $chave => $valor)  {
                if (!empty($valor))  {
                    if ($chave === 'RptDt') {
                            $data = new DateTime($valor);
                            $consulta->whereDate($chave, $data->format('Y-m-d'));
                    } else {
                        $consulta->where("$chave", 'like', "%$valor%");
                    }
                }
            }
            $documentos = $consulta->paginate($porPagina, ['*'], 'pgina', $pagina);
            return $documentos;
      }

      private function ehDataValida(string $data) {
                $formato = 'Y-m-d';
                $data = Date::createFromFormat($formato, $data);
                return $data && $data->format('Y-m-d') === $data;
      }
}