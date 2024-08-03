<?php

namespace Routes\Marketing;

use App\Http\Controllers\Marketing\SendTransactionalEmailController;
use Illuminate\Support\Facades\Route;

Route::get('/api/marketing/transactional-email', [SendTransactionalEmailController::class, '__invoke']);