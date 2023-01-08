<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthCheckController extends Controller {
    public function __invoke(Request $request) {
        return $this->successResponse([
            'result' => true
        ]);
    }
}
