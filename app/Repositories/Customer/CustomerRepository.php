<?php


namespace App\Repositories\Customer;


use App\EloquentModels\Customers\Customer;

class CustomerRepository extends \App\Abstracts\BaseRepository
{

	public function model()
	{
		return Customer::class;
	}
}
