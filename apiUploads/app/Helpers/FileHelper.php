<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class FileHelper
{
    public static function validateUpload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xls,xlsx,csv|max:10240',
        ]);
    }

    public static function validateHistory(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'file_name' => 'nullable|string',
            'date' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            throw new \Illuminate\Validation\ValidationException($validator);
        }
    }
    
    public static function validateSearchContent(array $data)
    {
        return Validator::make($data, [
            'TckrSymb' => 'nullable|string',
            'RptDt' => 'nullable|date',
        ]);
    }
}
