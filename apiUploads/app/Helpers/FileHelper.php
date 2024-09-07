<?php

namespace App\Helpers;

use Illuminate\Http\Request;

class FileHelper
{
    public static function validateUpload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xls,xlsx,csv|max:10240',
        ]);
    }
}
