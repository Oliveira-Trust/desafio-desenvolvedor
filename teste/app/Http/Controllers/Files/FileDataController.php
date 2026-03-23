<?php

namespace App\Http\Controllers\Files;

use App\Http\Controllers\Controller;
use App\Models\FileData;
use Illuminate\Http\Request;

class FileDataController extends Controller
{
    /**
     * Search data of files in the system.
     */
    public function searchFileData(Request $request){
        $query = FileData::query();

        if ($request->filled('tckrsymb')) {
            $query->where('TckrSymb', $request->TckrSymb);
        }

        if ($request->filled('rptdt')) {
            $query->where('RptDt', $request->RptDt);
        }

        return $query->paginate(15);
    }
}
