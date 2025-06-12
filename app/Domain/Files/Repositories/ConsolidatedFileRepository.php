<?php

namespace Domain\Files\Repositories;

use Domain\Files\Entities\ConsolidatedFile;

interface ConsolidatedFileRepository {
    public function getHistory(string|null $filename, string|null $date);
    public function createNew(ConsolidatedFile $data);
    public function registerLine(string $filename, array $chunk);
}
