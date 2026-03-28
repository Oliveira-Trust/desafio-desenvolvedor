<?php

namespace App\Services;

use App\Models\UploadHistory;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\UploadedFile;
use OpenSpout\Reader\CSV\Reader as CSVReader;
use OpenSpout\Reader\CSV\Options as CSVOptions;
use OpenSpout\Reader\XLSX\Reader as XLSXReader;

class InstrumentsService
{
    public function __construct(private UploadedFile $file, private String $reference_date)
    {
        $this->reference_date = Carbon::createFromFormat('Y-m-d', $this->reference_date)
            ->startOfDay()->format('Y-m-d');
    }

    public function saveFile(): Array
    {
        $fileHash = md5_file($this->file->getRealPath());

        if(UploadHistory::where('file_hash', $fileHash)->exists()){
            throw new Exception("File already processed previously.", 422);
        }

        $this->validateReferenceDate();

        $path = $this->file->storeAs('uploads', time() . $this->file->getClientOriginalName());

        return [
            "path" => $path,
            "fileName" => $this->file->getClientOriginalName(),
            "hash" => $fileHash,
            "date" => $this->reference_date
        ];
    }

    private function validateReferenceDate(): void
    {   
        try{
            $tempPath = $this->file->getRealPath();
            $extension = $this->file->getClientOriginalExtension();
    
            $reader = match (strtolower($extension)) {
                'csv' => new CSVReader(
                    new CSVOptions(FIELD_DELIMITER: ';')
                ),
    
                'xlsx' => new XLSXReader(),
    
                default => null
            };
    
            if(!$reader){
                throw new Exception("Uninitiated reader", 401);
            }
    
            $reader->open($tempPath);
    
            foreach ($reader->getSheetIterator() as $sheet) {
                foreach ($sheet->getRowIterator() as $index => $row) {
                    $cells = $row->toArray();
    
                    if ($index === 2) {
                        if (!in_array('RptDt', $cells) && !in_array('TckrSymb', $cells)) {
                            throw new Exception("Invalid file: column header not found on line 2.", 422);
                        }
                    }
    
                    if($index == 3) {
                        $fileDate = $cells[0];
    
                        if ($fileDate !== $this->reference_date) {
                            throw new Exception("Date mismatch: File is for {$fileDate}, but reference date is {$this->reference_date}.", 422);
                        }
    
                        break;
                    }
                }
            }
        }finally {
            $reader->close();
        }
    }
}