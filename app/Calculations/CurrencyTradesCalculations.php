<?php

namespace App\Calculations;

use App\Models\PaymentMethod;
use App\Models\CurrencyTrades;
use App\Models\FeesSetup;

class CurrencyTradesCalculations 
{
	
	public static function calculatePaymentMethodFeeValue (Array $data)
	{
		return $data["amount_brl"] * $data["payment_method_fee"] / 100;
	}

	public static function calculateAmountFeeValue (Array $data)
	{
		return $data["amount_brl"] * $data["amount_fee"]  / 100;
	}

	public static function calculateAmountNewCurrency(Array $data) 
	{
		return ($data["amount_brl"] - 
				(self::calculatePaymentMethodFeeValue($data) + self::calculateAmountFeeValue($data))) 
				/ $data["currency_rate"];
	} 

}
