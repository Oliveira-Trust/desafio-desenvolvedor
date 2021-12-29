<?php
namespace App\Http\Controllers;

use App\Domain\UseCases\Transactions\CreateConversion;
use App\Http\Controller;

class TransactionController extends Controller
{
    protected $userRepository;
    protected $currencyRepository;
    protected $transactionRepository;
    protected $paymentoRepository;

    public function __construct($request, $container)
    {
        parent::__construct($request, $container);
        $this->userRepository = $this->container['GetUserRepository']();
        $this->currencyRepository = $this->container['GetCurrencyRepository']();
        $this->transactionRepository = $this->container['GetTransactionRepository']();
        $this->paymentoRepository = $this->container['GetPaymentRepository']();
    }
    public function index($userid)
    {
        try{
            $user = $this->userRepository->getById((int)$userid);
            $transactions = $user->getTransactions();
            $this->response([ "data" => $transactions]);
        } catch(\Exception $e) {
            $response['status'] = 'error';
            $response['message'] = $e->getMessage();
            $this->response($response);
        }
    }
    public function conversion($userid)
    {
        try{
            $data = $this->request->getBody();
            $userRepository = $this->userRepository;
            $currencyRepository = $this->currencyRepository;
            $transactionRepository = $this->transactionRepository;
            $paymentRepository = $this->paymentoRepository;
            $createConversion = new CreateConversion(
                $data,
                $userid,
                $transactionRepository,
                $currencyRepository,
                $paymentRepository,
                $userRepository
            );
            $transaction = $createConversion->execute();
            $this->response(["status" => "sucesso", "data" => $transaction]);
        } catch(\Exception $e) {
            $response['status'] = 'error';
            $response['message'] = $e->getMessage();
            $this->response($response);
        }
        
    }
}
