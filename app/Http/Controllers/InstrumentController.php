<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportInstrumentRequest;
use App\Http\Resources\InstrumentResource;
use App\Models\Instrument;
use Illuminate\Support\Facades\Storage;

class InstrumentController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $instruments = Instrument::paginate(15);

        return InstrumentResource::collection($instruments);
    }

    public function upload(ImportInstrumentRequest $request)
    {
        set_time_limit(600);

        $path = $request->file('file')->store('imports');
        $fullPath = Storage::disk('local')->path($path);

        \App\Jobs\ProcessInstrumentImport::dispatch($fullPath);

        return response()->json([
            'message' => 'Upload concluído. 400k linhas estão sendo processadas.',
        ], 202);
    }
}
