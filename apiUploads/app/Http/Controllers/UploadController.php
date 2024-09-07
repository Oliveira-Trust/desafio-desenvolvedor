<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Upload;
use Illuminate\Support\Facades\Storage;
use App\Helpers\FileHelper;


class UploadController extends Controller
{
    public function upload(Request $request)
    {
        FileHelper::validateUpload($request);
        $file = $request->file("file");
        $fileName = $file->getClientOriginalName();
        $fileHash = hash_file('md5', $file->getRealPath());

        $fileExists = $this->verifyFileExists($fileHash);

        if (!$fileExists) {

            $path = $file->storeAs('uploads', $fileName);

            $data = $this->processUploadData($request, $fileName, $path, $file);

            $this->saveUpload($data);

            return response()->json(['message' => 'Arquivo carregado com sucesso!'], 201);
        }
        return response()->json(['message' => 'Arquivo já foi carregado.'], 400);
    }

    public function verifyFileExists($fileHash)
    {
        if (Upload::where('file_hash', $fileHash)->exists()) {
            return response()->json(['message' => 'Arquivo já foi enviado.'], 409);
        }
    }

    protected function processUploadData(Request $request, $fileName, $path, $file)
    {
        $fields = [
            'rptDt' => $request->input('rptDt', ''),
            'tckrSymb' => $request->input('tckrSymb', ''),
            'mktNm' => $request->input('mktNm', ''),
            'sctyCtgyNm' => $request->input('sctyCtgyNm', ''),
            'iSIN' => $request->input('iSIN', ''),
            'crpnNm' => $request->input('crpnNm', ''),
        ];

        $formattedFields = $this->formatFields($fields);

        return [
            'file_name' => $fileName,
            'file_path' => $path,
            'file_type' => $file->getClientOriginalExtension(),
            'rptDt' => $formattedFields['rptDt'],
            'tckrSymb' => $formattedFields['tckrSymb'],
            'mktNm' => $formattedFields['mktNm'],
            'sctyCtgyNm' => $formattedFields['sctyCtgyNm'],
            'iSIN' => $formattedFields['iSIN'],
            'crpnNm' => $formattedFields['crpnNm'],
        ];
    }

    protected function saveUpload(array $data)
    {
        $upload = new Upload();
        $upload->fill($data);
        $upload->save();
    }
    protected function formatFields(array $fields)
    {
        return [
            'rptDt' => strtolower($fields['rptDt'] ?? ''),
            'tckrSymb' => strtolower($fields['tckrSymb'] ?? ''),
            'mktNm' => strtolower($fields['mktNm'] ?? ''),
            'sctyCtgyNm' => strtolower($fields['sctyCtgyNm'] ?? ''),
            'iSIN' => strtolower($fields['iSIN'] ?? ''),
            'crpnNm' => strtolower($fields['crpnNm'] ?? ''),
        ];
    }
    
    public function history(Request $request)
    {
        FileHelper::validateHistory($request);

        $fileSearch =  Upload::query();

        if ($request->has('file_name')) {
            $fileName = md5($request->input('file_name'));
            $fileSearch->where('file_name', $fileName);
        }

        if ($request->has('date')) {
            $fileSearch->whereDate('created_at', $request->input('date'));
        }

        $results = $fileSearch->get();

        return response()->json($results);
    }

    public function searchContentFile(Request $request)
    {
        FileHelper::validateSearchContent($request->all());

        $contentFile = Upload::query();

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
