<?php
// app/UseCases/ConvertCurrencyUseCase.php

namespace App\UseCases;

use App\Entities\User;
use App\Gateways\CurrencyApiGateway;
use App\Repositories\CurrencyRepositoryInterface;
use Exception;

class ConvertCurrencyUseCase
{
    private $currencyGateway;
    private $currencyRepository;

    public function __construct(CurrencyApiGateway $currencyGateway, CurrencyRepositoryInterface $currencyRepository)
    {
        $this->currencyGateway = $currencyGateway;
        $this->currencyRepository = $currencyRepository;
    }

    public function execute(User $user, $baseCurrency, $targetCurrency, $amount, $paymentMethod)
    {
        if ($amount < 1000 || $amount > 100000) {
            throw new Exception('O valor para conversão deve ser maior que R$1.000,00 e menor que R$100.000,00');
        }

        // Obter a taxa de câmbio
        $exchangeRate = $this->currencyGateway->getExchangeRate($baseCurrency, $targetCurrency);

        // Calcular o valor convertido
        $convertedAmount = $amount * $exchangeRate;

        // Aplicar as taxas baseadas na forma de pagamento
        switch ($paymentMethod) {
            case 'boleto':
                $convertedAmount -= $convertedAmount * 0.0145;
                break;
            case 'cartao':
                $convertedAmount -= $convertedAmount * 0.0763;
                break;
            default:
                throw new Exception('Forma de pagamento inválida. Deve ser "boleto" ou "cartao".');
        }

        // Aplicar a taxa de conversão
        if ($amount < 3000) {
            $convertedAmount -= $convertedAmount * 0.02;
        } else {
            $convertedAmount -= $convertedAmount * 0.01;
        }

        // Armazenar a conversão no banco de dados
        $this->currencyRepository->storeConversion($user, $baseCurrency, $targetCurrency, $amount, $convertedAmount, $paymentMethod);

        return $convertedAmount;
    }
}
