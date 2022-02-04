<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Controllers\API\BaseController as BaseController;

class TestController extends BaseController
{
    public function index()
    {
        return $this->sendResponse([
            'test' => '?'
        ], "true");
        // dd('aa');
    }
}
