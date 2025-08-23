<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\ProductsList;

class ProcessFileRow implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $chunk;
    protected array $header;
    protected string $fileHash;

    public function __construct(array $chunk, array $header, string $fileHash)
    {
        $this->chunk = $chunk;
        $this->header = $header;
        $this->fileHash = $fileHash;
    }

    public function handle(): void
    {
        $dataToInsert = [];

        foreach ($this->chunk as $row) {
            // Combina header com valores da linha
            $data = array_combine($this->header, $row);
            
            if ($data && !empty(array_filter($data))) {
                // Remove chaves vazias
                $data = array_filter($data, fn($k) => $k !== '', ARRAY_FILTER_USE_KEY);
                
                $data['file_hash'] = $this->fileHash;
                
                $dataToInsert[] = $data;
            }
        }

        // Insert em lote para melhor performance
        if (!empty($dataToInsert)) {
            ProductsList::insert($dataToInsert);
        }
        
        // Libera memória
        unset($dataToInsert, $this->chunk);
    }
}