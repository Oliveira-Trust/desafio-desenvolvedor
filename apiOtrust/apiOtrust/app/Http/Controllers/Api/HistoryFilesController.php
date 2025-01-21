<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Upload;

class HistoryFilesController extends Controller
{
    public function index(Request $request)
    {
        $query = Upload::query();

        if ($request->has('file_name')) {
            $query->where('file_name', $request->file_name);
        }

        if ($request->has('upload_date')) {
            $query->whereDate('upload_date', $request->upload_date);
        }

        $uploads = $query->get();

        return response()->json($uploads);
    }
}
