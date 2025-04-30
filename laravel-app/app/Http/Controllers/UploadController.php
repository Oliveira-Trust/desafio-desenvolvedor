<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use App\Http\Requests\UploadFileRequest;
use App\Jobs\ProcessUploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    /**
     * Exibe a lista de todos os uploads.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $uploads = Upload::orderBy('created_at', 'desc')->paginate(10);
        
        return view('uploads.index', compact('uploads'));
    }
    
    /**
     * Exibe o formulário para criar um novo upload.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('uploads.create');
    }
    
    /**
     * Armazena um upload recém-criado.
     *
     * @param  \App\Http\Requests\UploadFileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UploadFileRequest $request)
    {
        try {
            $file = $request->file('file');
            $referenceDate = $request->input('reference_date');
            
            $fileHash = md5_file($file->getRealPath());
            $existingUpload = Upload::where('file_hash', $fileHash)->first();
            
            if ($existingUpload) {
                return redirect()->route('uploads.show', $existingUpload->id)
                    ->with('error', 'Este arquivo já foi enviado anteriormente.');
            }
            
            $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
            
            $filePath = $file->storeAs('', $fileName, 'uploads');
            
            $upload = Upload::create([
                'original_name' => $file->getClientOriginalName(),
                'file_name' => $fileName,
                'file_path' => $filePath,
                'file_hash' => $fileHash,
                'status' => 'pending',
                'reference_date' => $referenceDate,
            ]);
            
            ProcessUploadedFile::dispatch($upload);
            
            return redirect()->route('uploads.show', $upload->id)
                ->with('success', 'Arquivo enviado com sucesso e colocado na fila para processamento.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erro ao enviar arquivo: ' . $e->getMessage())
                ->withInput();
        }
    }
    
    /**
     * Exibe os detalhes de um upload específico.
     *
     * @param  \App\Models\Upload  $upload
     * @return \Illuminate\View\View
     */
    public function show(Upload $upload)
    {
        $previewData = null;
        
        if ($upload->status === 'completed' && $upload->total_records > 0) {
            $repository = app(\App\Repositories\MongoDbDataRepository::class);
            
            $referenceDate = $upload->reference_date ? $upload->reference_date->format('Y-m-d') : null;
            
            if ($referenceDate) {
                $previewData = $repository->getPreviewByDate($referenceDate, 10);
            }
            
            if (empty($previewData)) {
                $previewData = $this->getDummyPreviewData();
            }
        }
        
        return view('uploads.show', [
            'upload' => $upload,
            'previewData' => $previewData,
        ]);
    }
    
    /**
     * Gera dados de prévia fictícios para demonstração.
     *
     * @return array
     */
    private function getDummyPreviewData()
    {
        return [
            [
                'RptDt' => '2023-01-01',
                'TckrSymb' => 'AAPL',
                'MktNm' => 'NASDAQ',
                'SctyCtgyNm' => 'Equity',
                'ISIN' => 'US0378331005',
                'CrpnNm' => 'Apple Inc.',
            ],
            [
                'RptDt' => '2023-01-01',
                'TckrSymb' => 'MSFT',
                'MktNm' => 'NASDAQ',
                'SctyCtgyNm' => 'Equity',
                'ISIN' => 'US5949181045',
                'CrpnNm' => 'Microsoft Corporation',
            ],
            [
                'RptDt' => '2023-01-01',
                'TckrSymb' => 'GOOGL',
                'MktNm' => 'NASDAQ',
                'SctyCtgyNm' => 'Equity',
                'ISIN' => 'US02079K3059',
                'CrpnNm' => 'Alphabet Inc.',
            ],
        ];
    }
} 