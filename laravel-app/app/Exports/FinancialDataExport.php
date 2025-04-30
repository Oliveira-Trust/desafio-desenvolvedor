<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use App\Repositories\MongoDbDataRepository;

class FinancialDataExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    /**
     * Os parâmetros de busca.
     *
     * @var array
     */
    protected $params;

    /**
     * O repositório de dados.
     *
     * @var \App\Repositories\MongoDbDataRepository
     */
    protected $repository;

    /**
     * Cria uma nova instância de exportação.
     *
     * @param array $params
     * @return void
     */
    public function __construct(array $params = [])
    {
        $this->params = $params;
        $this->repository = app(MongoDbDataRepository::class);
    }

    /**
     * Retorna os dados da coleção.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $ticker = $this->params['symbol'] ?? null;
        $date = null;
        
        if (!empty($this->params['date'])) {
            $date = $this->params['date'];
        }
        elseif (!empty($this->params['start_date'])) {
            $date = $this->params['start_date'];
        }
        
        $limit = 5000;
        $results = $this->repository->search($ticker, $date, $limit, 0);
        
        if (!empty($results['data'])) {
            $data = collect($results['data']);
            
            if (!empty($this->params['market'])) {
                $data = $data->filter(function ($item) {
                    return !empty($item['MktNm']) && 
                        stripos($item['MktNm'], $this->params['market']) !== false;
                });
            }
            
            if (!empty($this->params['category'])) {
                $data = $data->filter(function ($item) {
                    return !empty($item['SctyCtgyNm']) && 
                        stripos($item['SctyCtgyNm'], $this->params['category']) !== false;
                });
            }
            
            if (!empty($this->params['isin'])) {
                $data = $data->filter(function ($item) {
                    return !empty($item['ISIN']) && 
                        stripos($item['ISIN'], $this->params['isin']) !== false;
                });
            }
            
            if (!empty($this->params['company'])) {
                $data = $data->filter(function ($item) {
                    return !empty($item['CrpnNm']) && 
                        stripos($item['CrpnNm'], $this->params['company']) !== false;
                });
            }
            
            if (!empty($this->params['end_date'])) {
                $data = $data->filter(function ($item) {
                    return !empty($item['RptDt']) && $item['RptDt'] <= $this->params['end_date'];
                });
            }
            
            return $data;
        }
        
        return collect([]);
    }

    /**
     * Define os cabeçalhos do arquivo Excel.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Data do Relatório',
            'Símbolo',
            'Mercado',
            'Categoria',
            'ISIN',
            'Empresa'
        ];
    }

    /**
     * Mapeia cada item da coleção para uma linha no Excel.
     *
     * @param mixed $item
     * @return array
     */
    public function map($item): array
    {
        return [
            $item['RptDt'] ?? 'N/A',
            $item['TckrSymb'] ?? 'N/A',
            $item['MktNm'] ?? 'N/A',
            $item['SctyCtgyNm'] ?? 'N/A',
            $item['ISIN'] ?? 'N/A',
            $item['CrpnNm'] ?? 'N/A',
        ];
    }

    /**
     * Estiliza o arquivo Excel.
     *
     * @param Worksheet $sheet
     * @return void
     */
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:F1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'FFE9ECEF',
                ],
            ],
        ]);
    }
} 