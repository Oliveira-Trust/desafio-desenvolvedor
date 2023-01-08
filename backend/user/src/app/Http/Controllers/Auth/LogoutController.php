<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller {
    public function __invoke(Request $request) {

        $request->user()->currentAccessToken()->delete();

        return $this->successResponse([
            'result' => true
        ]);
    }
}
