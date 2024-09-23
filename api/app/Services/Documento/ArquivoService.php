<?php

namespace App\Services\Documento;

use App\Models\Arquivo;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;

class ArquivoService
{
     static function processar(UploadedFile $arquivo)
     {
          // Calcula o hash do arquivo
        $hash = md5_file($arquivo->getRealPath());

        // Verifica se o arquivo com o mesmo hash já existe
        $existingFile = Arquivo::where('hash', $hash)->first();

          if ($existingFile) {
               throw new Exception('Este arquivo já foi enviado anteriormente.');
          }

          $diretorio = $arquivo->store('uploads',  'public');

          $dados = [
                    'nome' => $arquivo->getClientOriginalName(),
                    'diretorio' => $diretorio,
                    'url' => Storage::url($diretorio), // public para download
                    'data_processamento' => Date::now()->format('Y-m-d H:i:s'),
                    'hash' => $hash,
                    'status' => 'active'
               ];

          $arquivoModel = new Arquivo($dados);
          $arquivoModel->save();

          return $dados;

     }
}