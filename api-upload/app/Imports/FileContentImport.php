<?php

namespace App\Imports;

use App\Models\FileContent;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeImport;

class FileContentImport implements ToModel, WithHeadingRow, WithCustomCsvSettings, WithChunkReading, WithEvents
{
    protected $uploadId;
    protected $skipFirstRow = false; // Flag para indicar se deve pular a primeira linha

    public function __construct($uploadId)
    {
        $this->uploadId = $uploadId;
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';',
        ];
    }

    public function headingRow(): int
    {
        return $this->skipFirstRow ? 2 : 1; // Define a linha de cabeçalho, ignorando a primeira linha se necessário
    }

    public function model(array $row)
    {
        // Converte todas as chaves do array $row para minúsculas
        $row = array_change_key_case($row, CASE_LOWER);

        // Verifica se o conteúdo é um array associativo com chaves esperadas
        if (!is_array($row) || empty($row)) {
            return null;
        }

        // Mapeamento de chaves do CSV para as chaves esperadas
        $keyMapping = [
            'rptdt'              => 'RptDt',
            'tckrsymb'           => 'TckrSymb',
            'mktnm'              => 'MktNm',
            'sctyctgynm'         => 'SctyCtgyNm',
            'isin'               => 'ISIN',
            'crpnnm'             => 'CrpnNm',
            'asst'               => 'Asst',
            'asstdesc'           => 'AsstDesc',
            'sgmtnm'             => 'SgmtNm',
            'xprtndt'            => 'XprtnDt',
            'exrcpric'           => 'ExrcPric',
            'xprtncd'            => 'XprtnCd',
            'tradgstartdt'       => 'TradgStartDt',
            'tradgenddt'         => 'TradgEndDt',
            'basecd'             => 'BaseCd',
            'convscritnm'        => 'ConvsCritNm',
            'mtrtydttrgtpt'      => 'MtrtyDtTrgtPt',
            'reqrdconvsind'      => 'ReqrdConvsInd',
            'cficd'              => 'CFICd',
            'dlvryntcestartdt'   => 'DlvryNtceStartDt',
            'dlvryntceenddt'     => 'DlvryNtceEndDt',
            'optntp'             => 'OptnTp',
            'ctrctmltplr'        => 'CtrctMltplr',
            'asstqtnqty'         => 'AsstQtnQty',
            'allcnrndlot'        => 'AllcnRndLot',
            'tradgccy'           => 'TradgCcy',
            'dlvrytpnm'          => 'DlvryTpNm',
            'wdrwldays'          => 'WdrwlDays',
            'wrkdays'            => 'WrkgDays',
            'clnrdays'           => 'ClnrDays',
            'rlvrbasepricnm'     => 'RlvrBase',
        ];

        // Verificar e ajustar valores nulos e decimais em todas as chaves mapeadas
        foreach ($keyMapping as $csvKey => $expectedKey) {
            // Verifica se o valor está definido; caso contrário, define como null
            $row[$csvKey] = $row[$csvKey] ?? null;

            // Se o valor não for nulo, verifica se é um número decimal e ajusta
            if (!is_null($row[$csvKey])) {
                // Substituir vírgula por ponto nos campos que contêm números decimais
                if (is_numeric(str_replace(',', '.', $row[$csvKey]))) {
                    $row[$csvKey] = str_replace(',', '.', $row[$csvKey]);
                }
            }
        }


        // Cria a instância do modelo FileContent com os valores ajustados
        $fileContent = new FileContent([
            'upload_id'         => $this->uploadId,
            'RptDt'             => $row['rptdt'],
            'TckrSymb'          => $row['tckrsymb'],
            'Asst'              => $row['asst'],
            'AsstDesc'          => $row['asstdesc'],
            'SgmtNm'            => $row['sgmtnm'],
            'MktNm'             => $row['mktnm'],
            'SctyCtgyNm'        => $row['sctyctgynm'],
            'XprtnDt'           => $row['xprtndt'],
            'XprtnCd'           => $row['xprtncd'],
            'TradgStartDt'      => $row['tradgstartdt'],
            'TradgEndDt'        => $row['tradgenddt'],
            'BaseCd'            => $row['basecd'],
            'ConvsCritNm'       => $row['convscritnm'],
            'MtrtyDtTrgtPt'     => $row['mtrtydttrgtpt'],
            'ReqrdConvsInd'     => $row['reqrdconvsind'],
            'ISIN'              => $row['isin'],
            'CFICd'             => $row['cficd'],
            'DlvryNtceStartDt'  => $row['dlvryntcestartdt'],
            'DlvryNtceEndDt'    => $row['dlvryntceenddt'],
            'OptnTp'            => $row['optntp'],
            'CtrctMltplr'       => $row['ctrctmltplr'],
            'AsstQtnQty'        => $row['asstqtnqty'],
            'AllcnRndLot'       => $row['allcnrndlot'],
            'TradgCcy'          => $row['tradgccy'],
            'DlvryTpNm'         => $row['dlvrytpnm'],
            'WdrwlDays'         => $row['wdrwldays'],
            'WrkgDays'          => $row['wrkdays'],
            'ClnrDays'          => $row['clnrdays'],
            'RlvrBasePricNm'    => $row['rlvrbasepricnm'],
            'OpngFutrPosDay'    => $row['opngfutrposday'],
            'SdTpCd1'           => $row['sdtpcd1'],
            'UndrlygTckrSymb1'  => $row['undrlygtckrsymb1'],
            'SdTpCd2'           => $row['sdtpcd2'],
            'UndrlygTckrSymb2'  => $row['undrlygtckrsymb2'],
            'PureGoldWght'      => $row['puregoldwght'],
            'ExrcPric'          => $row['exrcpric'],
            'OptnStyle'         => $row['optnstyle'],
            'ValTpNm'           => $row['valtpnm'],
            'PrmUpfrntInd'      => $row['prmupfrntind'],
            'OpngPosLmtDt'      => $row['opngposlmtdt'],
            'DstrbtnId'         => $row['dstrbtnid'],
            'PricFctr'          => $row['pricfctr'],
            'DaysToSttlm'       => $row['daystosttlm'],
            'SrsTpNm'           => $row['srstpnm'],
            'PrtcnFlg'          => $row['prtcnflg'],
            'AutomtcExrcInd'    => $row['automtcexrcind'],
            'SpcfctnCd'         => $row['spcfctncd'],
            'CrpnNm'            => $row['crpnnm'],
            'CorpActnStartDt'   => $row['corpactnstartdt'],
            'CtdyTrtmntTpNm'    => $row['ctdytrtmnttpnm'],
            'MktCptlstn'        => $row['mktcptlstn'],
            'CorpGovnLvlNm'     => $row['corpgovnlvlnm'],
        ]);


        return $fileContent;
    }



    public function chunkSize(): int
    {
        return 1000;
    }

    public function registerEvents(): array
    {
        return [
            BeforeImport::class => function (BeforeImport $event) {
                // Lê a primeira linha do arquivo CSV
                $csvFile = fopen(request()->file('file')->getRealPath(), 'r');
                $firstLine = fgetcsv($csvFile, 0, ';');
                fclose($csvFile);

                // Verifica se a primeira linha contém "Status do Arquivo: Parcial"
                if ($firstLine && strpos($firstLine[0], 'Status do Arquivo: Parcial') !== false) {
                    $this->skipFirstRow = true; // Define a flag para pular a primeira linha
                }
            },
        ];
    }
}
