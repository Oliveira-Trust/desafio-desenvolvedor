<?php

namespace App\Http\Controllers;

use App\Models\Cotation;
use App\Services\CotationService;
use App\Services\EconomiaApiService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{

    protected $economiaApiService;
    protected $cotationService;

    public function __construct(EconomiaApiService $economiaApiService, CotationService $cotationService)
    {
        $this->economiaApiService = $economiaApiService;
        $this->cotationService = $cotationService;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
    }
}
