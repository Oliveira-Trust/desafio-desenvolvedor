<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UploadFileRequest;
use App\Http\Requests\SearchInstrumentRequest;
use Illuminate\Http\Request;
use App\Models\Upload;
use App\Models\Instrument;
use Illuminate\Support\Facades\Auth;
use App\Jobs\ProcessInstrumentFile;

class InstrumentController extends Controller
{
    private const SEARCH_CACHE_TTL = 300;

    public function upload(UploadFileRequest $request)
    {
        $file = $request->file('file');
        $hash = md5_file($file->getRealPath());

        if (Upload::where('hash', $hash)->exists()) {
            return response()->json(['error' => 'Arquivo já enviado anteriormente.'], 409);
        }

        $path = $file->store('uploads');

        $upload = Upload::create([
            'filename' => $file->getClientOriginalName(),
            'hash' => $hash,
            'path' => $path,
            'uploaded_by' => Auth::id(),
            'status' => 'pending',
            'user_id' => Auth::id(),
        ]);

        ProcessInstrumentFile::dispatch($upload->id);

        return response()->json(['message' => 'Upload realizado com sucesso! Processamento em background.', 'upload_id' => $upload->id]);
    }

    public function history(Request $request)
    {
        $query = Upload::query();

        if ($request->filled('filename')) {
            $query->where('filename', 'like', '%' . $request->filename . '%');
        }
        if ($request->filled('date')) {
            $query->whereDate('uploaded_at', $request->date);
        }

        $uploads = $query->orderByDesc('uploaded_at')->paginate(20);

        return response()->json($uploads);
    }

    public function search(SearchInstrumentRequest $request)
    {
        $cacheKey = sprintf(
            'search:TckrSymb:%s:RptDt:%s:page:%s',
            $request->input('TckrSymb', 'all'),
            $request->input('RptDt', 'all'),
            $request->input('page', 1)
        );

        $results = cache()->remember($cacheKey, self::SEARCH_CACHE_TTL, function () use ($request) {
            $query = Instrument::query();

            if ($request->filled('TckrSymb')) {
                $query->where('TckrSymb', $request->TckrSymb);
            }
            if ($request->filled('RptDt')) {
                $query->where('RptDt', $request->RptDt);
            }

            return $query->paginate(50);
        });

        return response()->json($results);
    }
}
