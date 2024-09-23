<?php

namespace App\Jobs;

use App\Models\Documento;
use App\Services\Documento\ImportarDocumento;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use PHPExcel_IOFactory;

class ProcessaArquivoCsv implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /**
     * Create a new job instance.
     */
    public function __construct(public string $caminhoArquivo)
    {
    
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {       
            $csv =\PhpOffice\PhpSpreadsheet\IOFactory::load($this->caminhoArquivo);
            $sheet  = $csv->getActiveSheet();

            $cabecalho = [];
           
            $dados = [];

            foreach($sheet->getRowIterator( ) as $indiceLinha => $linha) {

                    $dadosLinha = [];
                    foreach($linha->getCellIterator() as $celula) {
                        $dadosLinha[] = $celula->getValue();
                    }

                    if ($indiceLinha===1) {
                        $cabecalho = $dadosLinha;
                        continue;
                    }
                    $dados = [];
                    foreach($dadosLinha as $chave => $valor) {
                        $nomeColuna = isset($cabecalho[$chave]) ? $cabecalho[$chave] : "coluna_$chave";
                        $dados[$nomeColuna] = $valor;
                    }

                    $documentoModel = new Documento($dados);
                    $documentoModel->save();
                }
    }
}
