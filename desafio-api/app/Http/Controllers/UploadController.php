<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xlsx|max:2048',
        ]);

        $filename = $request->file('file')->getClientOriginalName();

        if (Upload::where('filename', $filename)->exists()) {
            return response()->json(['error' => 'Arquivo já enviado'], 400);
        }

        $path = $request->file('file')->storeAs('uploads', $filename);

        $upload = Upload::create([
            'filename' => $filename,
            'uploaded_at' => now(),
        ]);

        return response()->json(['message' => 'Upload realizado com sucesso'], 200);
    }

    public function history(Request $request)
    {
        $uploads = Upload::query();

        if ($request->has('filename')) {
            $uploads->where('filename', $request->filename);
        }

        if ($request->has('date')) {
            $uploads->whereDate('uploaded_at', $request->date);
        }

        return response()->json($uploads->get());
    }

}
