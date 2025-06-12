<?php

namespace Application\Files\Services;

use Application\Files\Jobs\ProcessConsolidatedFile;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ConsolidatedFileService {
    private string $disk;

    private Filesystem $storage;

    private string $basePath;

    public function __construct()
    {
        $this->disk = 's3';
        $this->basePath = config('upload.basePath');
        $this->storage = Storage::disk($this->disk);
    }

    public function resolvePath($path): string {
        return implode('/', [$this->basePath, $path]);
    }

    public function setDisk(string $driver) {
        $this->disk = $driver;
        return $this;
    }

    public function exists(string $path): bool {
        return $this->storage->exists($this->resolvePath($path));
    }

    public function store(string $filename, UploadedFile $file): string|bool {
        $path = $this->resolvePath($filename);

        $stored = $this->storage->put(
            $this->resolvePath($filename),
            file_get_contents($file),
        );

        if ($stored) return $path;
        return false;
    }

    public function get(string $path): string {
        return $this->storage->get($this->resolvePath($path));
    }

    public function readStream(string $path) {
        return $this->storage->readStream($this->resolvePath($path));
    }

    public function sendToQueue(string $path) {
        ProcessConsolidatedFile::dispatch($this->resolvePath($path));
    }
}
