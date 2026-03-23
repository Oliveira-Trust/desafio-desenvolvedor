<?php

namespace App\Http\Controllers\Files;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Requests\FileRequest;
use App\Jobs\ProcessFile;
use App\Models\File;

class FileController extends Controller
{
    /**
    * Upload doc in the system
    */
    public function store(FileRequest $request) {
        $validated = $request->validated();
        $file = $validated['file'];
        $extension = $file->getClientOriginalExtension();

        if (!in_array($extension, ['csv', 'xlsx', 'xls'])) {
            return response()->json(['error' => 'Extensão inválida'], 422);
        }

        $hash = md5_file($file->getRealPath());
        $filename = $hash . '.' . $extension;

        if(Storage::disk('public')->exists("files/$filename")) {
            return response()->json([
                'message' => 'Arquivo já enviado anteriormente'
            ], 409);
        }

        Storage::disk('public')->putFileAs('files', $file, $filename);

        $fileModel = $this->user()->files()->create([
            'original_name' => $file->getClientOriginalName(),
            'path' => 'files/' . $filename,
            'hash_name' => $hash,
            'extension' => $extension,
            'size' => $file->getSize(),
            'status' => 'processando',
        ]);

        $this->runFileQueue($fileModel);
        return response()->json($fileModel);
    }

    public function runFileQueue(File $file) {
        ProcessFile::dispatch((string)$file->id);
    }

    /**
    * History of docs in the system
    */
    public function historyFiles(Request $request) {
        $query = File::query();

        if($request->filled('name')) {
            $query->where('original_name', 'like', "%$request->name%");
        }

        if($request->filled('date')) {
            $query->whereDate('created_at', '>=', $request->date);
        }

        return response()->json([
            'files' => $query->orderBy('created_at')->get()
        ]);
    }
}
