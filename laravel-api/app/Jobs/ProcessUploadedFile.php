<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\SimpleExcel\SimpleExcelReader;
use App\Jobs\ProcessFileRow;
use App\Jobs\ChunkReadFilter;
use Illuminate\Support\Facades\Log;

class ProcessUploadedFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $filePath;
    protected string $extension;
    protected string $fileHash;

    public function __construct(string $filePath, string $extension, string $fileHash)
    {
        $this->filePath  = $filePath;
        $this->extension = $extension;
        $this->fileHash  = $fileHash;
    }

    public function handle(): void
    {
        $header = [
            'RptDt','TckrSymb','Asst','AsstDesc','SgmtNm','MktNm','SctyCtgyNm','XprtnDt','XprtnCd',
            'TradgStartDt','TradgEndDt','BaseCd','ConvsCritNm','MtrtyDtTrgtPt','ReqrdConvsInd','ISIN',
            'CFICd','DlvryNtceStartDt','DlvryNtceEndDt','OptnTp','CtrctMltplr','AsstQtnQty','AllcnRndLot',
            'TradgCcy','DlvryTpNm','WdrwlDays','WrkgDays','ClnrDays','RlvrBasePricNm','OpngFutrPosDay',
            'SdTpCd1','UndrlygTckrSymb1','SdTpCd2','UndrlygTckrSymb2','PureGoldWght','ExrcPric','OptnStyle',
            'ValTpNm','PrmUpfrntInd','OpngPosLmtDt','DstrbtnId','PricFctr','DaysToSttlm','SrsTpNm','PrtcnFlg',
            'AutomtcExrcInd','SpcfctnCd','CrpnNm','CorpActnStartDt','CtdyTrtmntTpNm','MktCptlstn','CorpGovnLvlNm'
        ];

        $chunkSize = 500;
        $chunk = [];

        SimpleExcelReader::create($this->filePath, $this->extension)
            ->useDelimiter(';')
            ->useHeaders($header)
            ->skip(1) // 1 linha de "Status do arquivo"
            ->getRows()
            ->each(function ($row) use ($header, $chunkSize, &$chunk) {
                // normaliza UTF-8
                $row = array_map(fn($v) => is_string($v) ? mb_convert_encoding($v, 'UTF-8', 'UTF-8') : $v, $row);
                
                $chunk[] = $row;
                
                // Quando atingir o tamanho do chunk, dispatcha o job
                if (count($chunk) >= $chunkSize) {
                    ProcessFileRow::dispatch($chunk, $header, $this->fileHash);
                    $chunk = []; // Limpa o chunk
                }
            });

        // Processa o último chunk se houver dados restantes
        if (!empty($chunk)) {
            ProcessFileRow::dispatch($chunk, $header, $this->fileHash);
        }
    }
}