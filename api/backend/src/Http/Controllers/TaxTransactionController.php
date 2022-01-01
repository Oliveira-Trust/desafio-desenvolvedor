<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\UseCases\TaxTransactions\EditTaxTransactions;
use App\Domain\UseCases\TaxTransactions\GetTaxTransactions;
use App\Helpers\Validate;
use App\Http\Controller;


class TaxTransactionController extends Controller
{
    protected $taxTransactionRepository;
    public function __construct($request, $container)
    {
        parent::__construct($request, $container);
        $this->taxTransactionRepository = $this->container['GetTaxTransactionRepository']();
    }
    public function index()
    {
        try{
            $this->isLogged();
            $getTaxTransaction = new GetTaxTransactions( $this->taxTransactionRepository);
            $taxTransaction = $getTaxTransaction->execute();
            $response = $taxTransaction->toArray();
            unset($response['id']);
            $this->response(["status" => "sucesso", "data" => $response]);
        }catch(\Exception $e){
            $data['status'] = 'error';
            $data['message'] = $e->getMessage();
            return $this->response($data);
        }
    }
    public function update()
    {
        try {
            $this->isLogged();
            $data = $this->request->getBody();
            $validate = new Validate();
            $editTaxTransaction = new EditTaxTransactions($data, $this->taxTransactionRepository, $validate);
            $taxTransaction = $editTaxTransaction->execute();
            $arrayResponse['status'] = 'sucesso';
            $arrayResponse['message'] = 'Taxas atualizadas com sucesso.';
            $arrayResponse['data'] = $taxTransaction->toArray();
            $this->response($arrayResponse);
        } catch (\Exception $e) {
            $data['status'] = 'error';
            $data['message'] = $e->getMessage();
            return $this->response($data);
        }
    }
}
