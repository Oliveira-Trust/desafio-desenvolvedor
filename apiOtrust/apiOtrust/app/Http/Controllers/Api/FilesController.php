<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Upload;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    public function files(Request $request)
    {
        $files = Upload::all();

        return response()->json([
            "message" => "All Files",
            "data" => $files,
        ]);
    }
}
