<?php

namespace Application\Files\Services;

use Application\Files\Jobs\ProcessConsolidatedFile;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;

class FileService {
    private string $disk;
    private Filesystem $storage;

    public function __construct()
    {
        $this->disk = 's3';
        $this->storage = Storage::disk($this->disk);
    }

    public function setDisk(string $driver) {
        $this->disk = $driver;
        return $this;
    }

    public function exists($path): bool {
        return $this->storage->exists($path);
    }

    public function store($path, $file) {
        $this->storage->put($path, $file);
    }

    public function get($path): string {
        return $this->storage->get($path);
    }

    public function sendToQueue($path) {
        ProcessConsolidatedFile::dispatch($path);
    }
}
