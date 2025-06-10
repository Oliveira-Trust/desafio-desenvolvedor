<?php

namespace Presentation\Api\Controllers;

use Illuminate\Support\Facades\Request;

class FileController {
    public function storeFile(Request $request) {
        dd($request->all());
    }
}
