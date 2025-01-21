<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Upload;

class SearchFilesController extends Controller
{
    public function search(Request $request)
    {
        $query = Upload::query();

        if ($request->has('TckrSymb')) {
            $query->where('data.TckrSymb', $request->TckrSymb);
        }

        if ($request->has('RptDt')) {
            $query->where('data.RptDt', $request->RptDt);
        }

        $results = $query->paginate(10);

        return response()->json($results);
    }
}
