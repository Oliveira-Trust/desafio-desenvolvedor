<?php


namespace App\Repositories\Admin;


use App\EloquentModels\Admin\ExchangePurchaseSetup;

class ExchangePurchaseSetupRepository extends \App\Abstracts\BaseRepository
{

	public function model()
	{
		return ExchangePurchaseSetup::class;
	}
}
