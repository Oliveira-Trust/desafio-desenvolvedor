<?php

namespace App\Http\Controllers\Conversion;

use App\Http\Controllers\Controller;
use App\Services\ConversionHistoryService;

class ConversionHistoryController extends Controller
{

    /**
     * @var ConversionHistoryService
     */
    protected $conversionHistoryService;

    public function __construct(ConversionHistoryService $conversionHistoryService)
    {
        $this->conversionHistoryService = $conversionHistoryService;
    }


    /**
     * Carregar pagina web com o histórico de conversão do usuário logado.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        $data = $this->conversionHistoryService->all();
        return view('conversion-history', [
            'data' => $data
        ]);
    }
}
