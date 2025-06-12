<?php

namespace Domain\Files\Entities;

use Domain\Files\Enums\ConsolidatedFileStatus;
use Illuminate\Support\Facades\Date;

class ConsolidatedFile {
    public string $createdAt;

    public string|null $updatedAt;

    public function __construct(
        public string $filename,
        public string $path,
        public ConsolidatedFileStatus $status,
        public array $registers,
    )
    {}

    public static function create(
        string $filename,
        string $path,
        ConsolidatedFileStatus $status,
        array $registers = [],
    ) {
        $consolidatedFile = new ConsolidatedFile(
            $filename,
            $path,
            $status,
            $registers
        );

        $consolidatedFile->createdAt = Date::now();
        $consolidatedFile->updatedAt = null;

        return $consolidatedFile;
    }
}
