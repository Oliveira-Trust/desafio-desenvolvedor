<?php

namespace App\Services;

use App\Models\Arquivo;
use App\Models\HistoricoArquivo;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class ArquivoService
{
    public function uploadArquivo(UploadedFile $arquivo): string
    {
        $tamanhoLote = 100;
        $conteudoParaImportar = [];

        $arquivoParaSalvar = [
            'nome' => $arquivo->getClientOriginalName(),
            'tamanho' => $arquivo->getSize()
        ];

        $caminho = $arquivo->getRealPath();
        $dadosDoArquivo = file_get_contents($caminho);
        $conteudo = explode("\n", $dadosDoArquivo);
        $cabecalho = str_getcsv($conteudo[1], ';');
        $linhas = array_slice($conteudo, 2);

        foreach (array_chunk($linhas, $tamanhoLote) as $lote) {
            foreach ($lote as $linha) {
                $campos = str_getcsv($linha, ';');

                if (count($cabecalho) !== count($campos)) {
                    continue;
                }

                $linhaConteudo = array_combine($cabecalho, $campos);
                $conteudoParaImportar[] = $linhaConteudo;
            }
        }

        DB::beginTransaction();

        try {
            $arquivoSalvo = Arquivo::query()->create($arquivoParaSalvar);

            foreach (array_chunk($conteudoParaImportar, $tamanhoLote) as $lote) {
                $arquivoSalvo->conteudo()->createMany($lote);
            }

            $arquivoSalvo->historico()->create(['nome_arquivo' => $arquivoSalvo->nome]);

            DB::commit();
            return 'Sucesso';
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }

    public function verificaSeJaFoiEnviado(UploadedFile $arquivo): bool
    {
        return HistoricoArquivo::query()
                ->where('nome_arquivo', '=', $arquivo->getClientOriginalName())
                ->count() > 0;
    }
}
