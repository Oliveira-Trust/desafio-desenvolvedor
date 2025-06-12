<?php

namespace Domain\Files\Entities;

use Domain\Files\Enums\ConsolidatedFileStatus;

class ConsolidatedFileEntity {
    public string $createdAt;

    public string $updatedAt;

    public function __construct(
        public string $filename,
        public ConsolidatedFileStatus $status,
        public array $registers,
    )
    {}

    public function getFilename(): string {
        return $this->filename;
    }

    public function getStatus(): ConsolidatedFileStatus {
        return $this->status;
    }

    public function getRegisters(): array {
        return $this->registers;
    }

    public static function create(
        string $filename,
        ConsolidatedFileStatus $status,
        array $registers,
    ) {
        return new ConsolidatedFileEntity(
            $filename,
            $status,
            $registers
        );
    }
}
