<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\RateRepository;

class RatesController extends Controller
{

    /**
     * @var private rateRepository
     */

    private $rateRepository;

    /**
     * Método construtor
     */

    public function __construct()
    {
        $this->rateRepository = new RateRepository();
    }

    /**
     * Método reposável por invocar a  recuperãção dos valores e taxas para painel de controles
     * 
     * @return collection $rates
     */

    public function getAll()
    {
        $rates =  $this->rateRepository->getAll();
        return response()->json($rates,$rates['httpCode']);
    }

    /**
     * Método reponsável por invocar a alteração dos valores e taxas do painel de controle
     * 
     * @param Request $request
     * 
     * @return collection $UpdateRates
     */

    public function update(Request $request)
    {
        $data =  $request->all();
        $updateRates = $this->rateRepository->update($data);
        return response()->json($updateRates,$updateRates['httpCode']);
    }   

}
