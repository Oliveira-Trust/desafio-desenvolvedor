<?php

use App\Base\Providers\AppServiceProvider;
use App\FileUpload\Providers\FileUploadServiceProvider;
use App\Instrument\Providers\InstrumentServiceProvider;
use App\User\Providers\UserServiceProvider;

return [
    AppServiceProvider::class,
    UserServiceProvider::class,
    FileUploadServiceProvider::class,
    InstrumentServiceProvider::class,
];
