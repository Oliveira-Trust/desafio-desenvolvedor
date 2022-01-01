<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Domain\UseCases\Currency\GetAllCurrency;
use App\Domain\UseCases\Currency\GetCurrency;
use App\Domain\UseCases\Transactions\CreateConversion;

class HomeController extends Controller
{
    protected $currencyRepository;
    public function __construct($request, $container)
    {
        parent::__construct($request, $container);
        $this->currencyRepository = $this->container['GetCurrencyRepository']();
    }
    public function index()
    {
        try{
            $this->isLogged();
            $getAllCurrency = new GetAllCurrency($this->http, $this->currencyRepository);
            $data = $getAllCurrency->execute();
            $this->response(["status" => "sucesso", "data" => $data]);
        }catch(\Exception $e){
            $data['status'] = 'error';
            $data['message'] = $e->getMessage();
            return $this->response($data);
        }
    }
    public function getCurrency($code, $codein)
    {
        try {
            $this->isLogged();
            $codeCurrenci = $code. '-'.$codein;
            $getCurrency = new GetCurrency($this->http, $this->currencyRepository);
            $data = $getCurrency->execute($codeCurrenci);
            $this->response(["status" => "sucesso", "data" => $data]);
        } catch (\Exception $e) {
            $data['status'] = 'error';
            $data['message'] = $e->getMessage();
            return $this->response($data);
        }
    }
}
