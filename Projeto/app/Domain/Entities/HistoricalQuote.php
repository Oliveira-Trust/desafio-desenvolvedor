
<?php
// app/Domain/Entities/HistoricalQuote.php
namespace App\Domain\Entities;

class HistoricalQuote
{
    private $id;
    private $user;
    private $baseCurrency;
    private $targetCurrency;
    private $exchangeRate;
    private $amount;
    private $conversionFee;
    private $paymentFee;
    private $total;
    
    public function __construct($id, $user, $baseCurrency, $targetCurrency, $exchangeRate, $amount, $conversionFee, $paymentFee, $total) {
        $this->id = $id;
        $this->user = $user;
        $this->baseCurrency = $baseCurrency;
        $this->targetCurrency = $targetCurrency;
        $this->exchangeRate = $exchangeRate;
        $this->amount = $amount;
        $this->conversionFee = $conversionFee;
        $this->paymentFee = $paymentFee;
        $this->total = $total;
    }
    
    // getters and setters
}
