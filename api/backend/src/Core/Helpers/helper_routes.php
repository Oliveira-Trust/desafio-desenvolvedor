<?php
 
use App\Core\Route;
use App\Core\Request;
use App\Domain\Repositories\Database\CurrencyRepositoryDatabase;
use App\Domain\Repositories\Database\PaymentRepositoryDatabase;
use App\Domain\Repositories\Database\TaxTransactionRepositoryDatabase;
use App\Domain\Repositories\Database\TransactionRepositoryDatabase;
use App\Domain\Repositories\Database\UserRepositoryDatabase;
use App\Helpers\EntityManagerFactory;
use App\Helpers\HttpRequest;
use App\Service\Jwt\Jwt;

function request()
{
    return new Request();
} 
function resolve($request = null, $container)
{
    if(is_null($request)) {
        $request = request();
    }
    return Route::resolve($request, $container);
} 
function route($name, $params = null)
{
    return Route::translate($name, $params);
}
function back()
{
    return header('Location: ' . $_SERVER['HTTP_REFERER']);
}
function getAuth(){
    return new Jwt(env('SECRET_KEY_TOKEN'));
}
function getHttp(){
    return new HttpRequest(['url'=> env('API_ECONOMIA_ALL')]);
}
$entityManager = EntityManagerFactory::getEntityManager();
$container['GetUserRepository'] = function () use ($entityManager){
     return new UserRepositoryDatabase($entityManager);
};
$container['GetCurrencyRepository'] = function () use ($entityManager){
    return new CurrencyRepositoryDatabase($entityManager);
};
$container['GetTransactionRepository'] = function () use ($entityManager){
     return new TransactionRepositoryDatabase($entityManager);
};
$container['GetPaymentRepository'] = function () use ($entityManager){
     return new PaymentRepositoryDatabase($entityManager);
};
$container['GetTaxTransactionRepository'] = function () use ($entityManager){
    return new TaxTransactionRepositoryDatabase($entityManager);
};
