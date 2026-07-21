<?php

namespace App\Jobs;

use App\Models\FileUpload;
use App\Models\Instrument;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

use OpenSpout\Reader\CSV\Reader as CsvReader;
use OpenSpout\Reader\CSV\Options as CsvOptions;
use OpenSpout\Reader\XLSX\Reader as XlsxReader;

class ProcessFileJob implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue, SerializesModels;

    protected $upload;

    public $timeout = 1200;

    /**
     * Create a new job instance.
     */
    public function __construct(FileUpload $upload)
    {
        $this->upload = $upload;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        set_time_limit(0);

        $this->upload->update(['status' => 'PROCESSING']);

        try {
            $extension = strtolower(pathinfo($this->upload->file_name, PATHINFO_EXTENSION));
            $relativePath = 'uploads/' . $this->upload->file_hash . '.' . $extension;

            if (!Storage::exists($relativePath)) {
                throw new \Exception("Arquivo não encontrado no armazenamento: $relativePath");
            }

            $path = Storage::path($relativePath);

            // criando leitor dependendo da extensão
            $reader = match($extension) {
                'csv', 'txt' => new CsvReader(new CsvOptions(
                    FIELD_DELIMITER: ';',
                )),
                'xlsx', 'xls' => new XlsxReader(),
                default => throw new \Exception("Formato de arquivo não suportado: $extension"),
            };

            $reader->open($path);

            $batch = [];
            $batchSize = 1000;
            // pular cabeçalho
            $isHeader = true;


            foreach ($reader->getSheetIterator() as $sheet) {
                // itera linha a linha pra n lotar a memória
                foreach ($sheet->getRowIterator() as $row) {

                    $cells = $row->toArray();

                    // procurar pela coluna RptDt para identificar o cabeçalho
                    if ($isHeader == true) {
                        $colunaA = isset($cells[0]) ? trim($cells[0]) : '';

                        if (strcasecmp($colunaA, 'RptDt') !== 0) {
                            continue; // ainda no cabeçalho
                        }

                        $isHeader = false; // encontrou o cabeçalho, agora processa as linhas seguintes
                        continue; // pular a linha do cabeçalho
                    }

                    // pula linhas vazias ou muito curtas
                    if (count($cells) < 2) {
                        continue;
                    }

                    // helper para limpar dados
                    $cleanData = array_map(function($cell) {
                        if (is_string($cell)) {
                            return mb_convert_encoding($cell, 'UTF-8', 'ISO-8859-1');
                        }
                        if($cell instanceof \DateTimeInterface) {
                            return $cell->format('Y-m-d');
                        }
                        return $cell;
                    }, $cells);

                    // montar o array
                    $batch[] = [
                        'file_upload_id'  => $this->upload->id,
                        'rpt_dt'          => $this->formatDate($cleanData[0]),
                        'tckr_symb'       => $cleanData[1],
                        'mkt_nm'          => $cleanData[5] ?? null,
                        'scty_ctgy_nm'    => $cleanData[6] ?? null,
                        'isin'            => $cleanData[15] ?? null,
                        'crpn_nm'         => $cleanData[47] ?? null,
                        'created_at'      => now(),
                        'updated_at'      => now(),
                    ];

                    // inserir em lote e limpar o array
                    if (count($batch) >= $batchSize) {
                        Instrument::insert($batch);
                        $batch = [];
                    }
                }
            }

            // inserir o que sobrou
            if (!empty($batch)) {
                Instrument::insert($batch);
            }

            $reader->close();
            $this->upload->update(['status' => 'COMPLETED']);

        } catch (\Throwable $e) {
            Log::critical("Falha Job ID {$this->upload->id}: " . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            $cleanError = mb_convert_encoding($e->getMessage(), 'UTF-8', 'UTF-8');

            $this->upload->update([
                'status' => 'FAILED',
                'error_message' => substr($cleanError, 0, 1000),
            ]);

            throw $e;
        }
    }

    // helper básico para garantir que esta no formato Y-m-d
    private function formatDate($date)
    {
        if (!$date) return null;

        if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
            return $date;
        }

        try {
            return \Carbon\Carbon::parse(str_replace('/', '-', $date))->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }
}
