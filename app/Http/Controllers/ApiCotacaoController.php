<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\ApiCotacaoService;

class ApiCotacaoController extends Controller
{
    protected $service;

    public function __construct(ApiCotacaoService $objApiCotacaoService){

        $this->service = $objApiCotacaoService;

    }

    public function buscarCotacao(String $strParametroMoeda){

        return $this->service->buscarCotacao($strParametroMoeda);

    }

}
