<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Upload;
use Illuminate\Support\Facades\Storage;
use App\Helpers\FileHelper;
use App\Imports\UploadsContentsImport;
use App\Models\UploadsContents;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;


class UploadController extends Controller
{
    public function upload(Request $request)
    {
        // FileHelper::validateUpload($request);
        $file = $request->file("file");
        $fileName = $file->getClientOriginalName();
        $fileType = $file->getClientOriginalExtension();

        if ($this->verifyFileExists($fileName)) {
            return response()->json(['message' => 'Arquivo cadastrado anteriormente.'], 409);
        }

        $path = $file->storeAs('uploads', $fileName);



        $upload = $this->saveUpload($fileName, $fileType, $path);

        $this->readAndProcessCsv($fileName, $path, $upload);


        return response()->json(['message' => 'Arquivo carregado com sucesso!'], 201);
    }

    public function verifyFileExists($fileName)
    {
        return Upload::where('file_name', $fileName)->exists();
    }

    protected function readAndProcessCsv($fileName, $path, $upload)
    {
        $filePath = storage_path('app/' . $path);
        $dataFile = array_map('str_getcsv', file($filePath));

        $header = array_shift($dataFile); // remove primeira linha
        array_shift($dataFile); //remove cabecalho das colunas

        foreach ($dataFile as $row) {
            UploadsContents::create([
                'upload_id' => $upload->id,
                'rptDt' => $row[0] ?? null,
                'tckrSymb' => $row[1] ?? null,
                'mktNm' => $row[2] ?? null,
                'sctyCtgyNm' => $row[3] ?? null,
                'iSIN' => $row[4] ?? null,
                'crpnNm' => $row[5] ?? null,
            ]);
        }
    }

    protected function saveUpload($fileName, $fileType, $path)
    {
        $upload = new Upload();
        $upload->file_name = $fileName;
        $upload->file_type = $fileType;
        $upload->file_path = $path;

        $upload->save();

        return $upload;
    }

    public function history(Request $request)
    {
        FileHelper::validateHistory($request);

        $fileSearch = Upload::query();

        if ($request->has('file_name')) {
            $fileName = $request->input('file_name');
            $fileSearch->where('file_name', $fileName);
        }

        if ($request->has('date') && $request->input('date')) {
            $fileSearch->whereDate('created_at', Carbon::createFromFormat('d-m-Y', $request->input('date'))->format('Y-m-d'));
        }

        $results = $fileSearch->get();

        if ($results->isEmpty()) {
            return response()->json(['message' => 'Arquivo não encontrado.'], 404);
        }

        return response()->json($results);
    }

    public function searchContentFile(Request $request)
    {

        $contentFile = UploadsContents::query();

        if ($request->has('TckrSymb') && $request->has('RptDt')) {
            $contentFile->where('tckrSymb', $request->input('TckrSymb'))
                ->where('rptDt', $request->input('RptDt'));
        }

        $results = $contentFile->paginate(15);

        $formattedResults = [];

        foreach ($results as $item) {

            $formattedResults[] = [
                'RptDt' => $item->rptDt,
                'TckrSymb' => $item->tckrSymb,
                'MktNm' => $item->mktNm,
                'SctyCtgyNm' => $item->sctyCtgyNm,
                'ISIN' => $item->iSIN,
                'CrpnNm' => $item->crpnNm,
            ];
        }

        return response()->json([
            'data' => $formattedResults,
            'current_page' => $results->currentPage(),
            'total_pages' => $results->lastPage(),
            'total_results' => $results->total(),
        ]);
    }
}
