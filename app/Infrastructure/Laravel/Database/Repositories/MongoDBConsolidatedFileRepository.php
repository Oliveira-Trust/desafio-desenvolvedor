<?php

namespace Infrastructure\Laravel\Database\Repositories;

use Exception;
use Domain\Files\Entities\ConsolidatedFile;
use Domain\Files\Repositories\ConsolidatedFileRepository;
use Illuminate\Database\Connection;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class MongoDBConsolidatedFileRepository implements ConsolidatedFileRepository {
    private Connection $conn;

    public function __construct()
    {
        $this->conn = DB::connection('mongodb');
    }

    public function createNew(ConsolidatedFile $data): string
    {
        $data->createdAt = Date::now();
        $data->updatedAt = null;

        return $this->conn->table('consolidated_files')->insertGetId([
            'filename' => $data->filename,
            'status' => $data->status,
            'createdAt' => $data->createdAt,
            'updatedAt' => $data->updatedAt,
        ]);
    }

    public function registerLine(string $filename, array $chunk)
    {
        $fileExists = $this->conn->table('consolidated_files')->select('_id')
            ->where('filename', '=', $filename)
            ->exists();

        if (!$fileExists) {
            throw new Exception('Consolidated file registry not found');
        }

        $this->conn->table('imported_data')->insert(
            $chunk
        );
    }
}
