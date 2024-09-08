<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class FileHelper
{
    public static function validateUpload(Request $request)
    {
        $messages = [
            'file.required' => 'Nenhum arquivo foi enviado.',
            'file.file' => 'O item enviado não é um arquivo válido.',
            'file.mimes' => 'Tipo de arquivo não suportado. Aceitamos apenas arquivos do tipo xls, xlsx, ou csv.',
            'file.max' => 'O tamanho máximo do arquivo é 10 MB.',
        ];
    
        $request->validate([
            'file' => 'required|file|mimes:xls,xlsx,csv|max:10240',
        ], $messages);
    }

    public static function validateHistory(Request $request)
    {
        $messages = [
            'date.date_format' => 'O formato da data é inválido. Use o formato d-m-Y.',
        ];
    
        $request->validate([
            'file_name' => 'sometimes|string',
            'date' => 'sometimes|date_format:d-m-Y'
        ], $messages);
    }
    

}
