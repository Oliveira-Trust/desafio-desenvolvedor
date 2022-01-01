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
        $this->taxTransactionRepository = $this->container['GetTaxTransactionRepository']();
    }
    public function index($userid)
    {
        try{
            $this->isLogged();
            $user = $this->userRepository->getById((int)$userid);
            if(!$user){
                throw new \Exception("No users found.");
            }
            $taxTransaction = $this->taxTransactionRepository->getTaxTransaction();
            $transactions = $user->getTransactions($taxTransaction);
            $this->response([ "data" => $transactions]);
        } catch(\Exception $e) {
            $data['status'] = 'error';
            $data['message'] = $e->getMessage();
            return $this->response($data);
        }
    }
    public function conversion()
    {
        try{
            $this->isLogged();
            $data = $this->request->getBody();
            $headerRequest = $this->request->getHeaders();
            $token = $headerRequest['Authorization'] ?? null;

            $dataUser = $this->auth->validate($token);
            $userRepository = $this->userRepository;
            $currencyRepository = $this->currencyRepository;
            $transactionRepository = $this->transactionRepository;
            $paymentRepository = $this->paymentoRepository;
            $taxTransactionRepository = $this->taxTransactionRepository;
            $createConversion = new CreateConversion(
                $data,
                $dataUser->id,
                $transactionRepository,
                $currencyRepository,
                $paymentRepository,
                $userRepository,
                $taxTransactionRepository
            );
            $transaction = $createConversion->execute();
            $this->response(["status" => "sucesso", "data" => $transaction]);
        } catch(\Exception $e) {
            $data['status'] = 'error';
            $data['message'] = $e->getMessage();
            return $this->response($data);
        }
        
    }
}
