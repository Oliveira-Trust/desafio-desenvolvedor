<?php

declare(strict_types=1);

namespace App\FileUpload\Providers;

use App\FileUpload\Interfaces\FileUploadRepositoryInterface;
use App\FileUpload\Repositories\FileUploadRepository;
use Illuminate\Support\ServiceProvider;

class FileUploadServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(FileUploadRepositoryInterface::class, FileUploadRepository::class);
    }
}
