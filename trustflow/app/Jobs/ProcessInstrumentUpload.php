<?php

namespace App\Jobs;

use App\Models\Instrument;
use App\Models\UploadHistory;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use OpenSpout\Reader\CSV\Reader as CSVReader;
use OpenSpout\Reader\CSV\Options as CSVOptions;
use OpenSpout\Reader\XLSX\Reader as XLSXReader;

class ProcessInstrumentUpload implements ShouldQueue
{
    use Queueable;
    public int $timeout = 1800; // 30 minutos

    public function __construct(private UploadHistory $history, private string $path)
    {}

    public function handle(): void
    {
        DB::disableQueryLog();
        $fullPath = Storage::path($this->path);

        if(!file_exists($fullPath)){
            Log::error("File not found in the path: {$fullPath}");
            return;
        }

        $extension = pathinfo($fullPath, PATHINFO_EXTENSION);

        $reader = match (strtolower($extension)) {
            'csv' => new CSVReader(
                new CSVOptions(FIELD_DELIMITER: ';')
            ),

            'xlsx' => new XLSXReader(),

            default => null
        };

        if(!$reader){
            Log::error("Uninitiated reader");
            return;
        }

        $reader->open($fullPath);
        $batchSize = 1000;
        $batchData = [];
        $totalRows = 0;
        $headers = [];

        $fillable = (new Instrument())->getFillable();

        
        try{
            DB::beginTransaction();

            $this->history->update([
                'status' => 'processing'
            ]);

            foreach ($reader->getSheetIterator() as $sheet) {
                foreach ($sheet->getRowIterator() as $index => $row) {
                    $cells = $row->toArray();

                    if (empty($headers) && in_array('TckrSymb', $cells)) {
                        $headers = $cells;
                        continue;
                    }

                    if (!empty($headers)) {
                        $dataFromFile = array_combine($headers, $cells);
                        
                        $record = [
                            'upload_history_id' => $this->history->id,
                            'created_at' => now(),
                            'updated_at' => now()
                        ];

                        foreach($fillable as $field) {
                            if(array_key_exists($field, $dataFromFile)) {
                                $val = $dataFromFile[$field];


                                if (in_array($field, ['ExrcPric', 'CtrctMltplr'])) {
                                    $val = str_replace(',', '.', $val);
                                }

                                if (is_string($val)) {
                                    $val = mb_convert_encoding($val, 'UTF-8', 'ISO-8859-1');
                                }

                                $record[$field] = $val === '' ? null : $val;
                            }
                        }

                        $batchData[] = $record;
                        $totalRows++;

                        if (count($batchData) >= $batchSize) {
                            Instrument::insert($batchData);
                            $batchData = [];
                        }
                    }
                }
            }

            if (!empty($batchData)) {
                Instrument::insert($batchData);
            }

            $this->history->update([
                'total_rows' => $totalRows,
                'status' => 'completed'
            ]);

            Cache::tags(['instruments_history'])->flush();
            Cache::tags(["instruments_data"])->flush();

            DB::commit();

        }catch(Exception $error) {
            DB::rollBack();
            Log::error("Erro ao processar upload ID {$this->history->id}: " . $error->getMessage());
            $this->history->update([
                'status' => 'failed'
            ]);
            throw $error;
        }finally{
            $reader->close();
        }

    }
}
