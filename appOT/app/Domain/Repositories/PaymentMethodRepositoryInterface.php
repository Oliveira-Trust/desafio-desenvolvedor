<?php
namespace App\Domain\Repositories;

use App\Http\Requests\PaymentMethodRequest;

interface PaymentMethodRepositoryInterface{
    public function index(); 
    public function store(PaymentMethodRequest $request); 
    public function show(int $id);
    public function getTax(int $id):float;

}
