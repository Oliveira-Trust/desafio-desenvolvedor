<?php

namespace App\Http\Controllers\Awesome;

use App\Http\Controllers\Controller;
use App\Services\BuyService;
use Illuminate\Http\Request;

class BuyController extends Controller
{
    private $buyService;

    public function __construct()
    {
        $this->buyService = new BuyService();
    }

    public function buy(Request $request)
    {
        $request->validate(
            [
                'origemMoeda' => 'required|string',
                'destinoMoeda' => 'required|string|different:origemMoeda',
                'valor' => 'required|numeric|min:1000|max:100000',
                'pagamento' => 'required'
            ],
        );

        return $this->buyService->createNew($request->all());
    }

    public function historic()
    {

        $historics = auth()->user()->historics;

        return view('historic', compact('historics'));
    }
}
