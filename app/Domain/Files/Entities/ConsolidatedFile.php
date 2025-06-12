<?php

namespace Domain\Files\Entities;

use Domain\Files\Enums\ConsolidatedFileStatus;

class ConsolidatedFile {
    public string|null $createdAt = null;

    public string|null $updatedAt = null;

    public function __construct(
        public string $filename,
        public string $path,
        public ConsolidatedFileStatus $status,
    )
    {}

    public static function create(
        string $filename,
        string $path,
        ConsolidatedFileStatus $status,
    ) {
        $consolidatedFile = new ConsolidatedFile(
            $filename,
            $path,
            $status,
        );

        return $consolidatedFile;
    }
}
