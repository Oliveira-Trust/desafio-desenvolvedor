<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Repositories\Customer\CustomerExchangeRepository;
use App\Repositories\Customer\ExchangePurchaseSetupRepository;
use App\Repositories\Customer\TaxRepository;
use Illuminate\Http\Request;
use ExchangeRate\ClientExchange;

class ExchangesController extends Controller
{

    /**
     * @var ExchangePurchaseSetupRepository
     */
    private $exchangePurchaseSetupRepository;
    /**
     * @var TaxRepository
     */
    private $taxRepository;
    /**
     * @var CustomerExchangeRepository
     */
    private $customerExchangeRepository;

    /**
     * @param ExchangePurchaseSetupRepository $exchangePurchaseSetupRepository
     * @param TaxRepository $taxRepository
     * @param CustomerExchangeRepository $customerExchange
     */
    public function __construct(ExchangePurchaseSetupRepository $exchangePurchaseSetupRepository, TaxRepository $taxRepository, CustomerExchangeRepository $customerExchangeRepository)
    {
        $this->exchangePurchaseSetupRepository = $exchangePurchaseSetupRepository;
        $this->taxRepository = $taxRepository;
        $this->customerExchangeRepository = $customerExchangeRepository;
    }


    public function index(Request $request)
    {


    }

    public function calculatePurchase(Request $request)
    {
        $customer = auth()->user()->customer;
        $calc = $request->get('calc');
        $exchange = ClientExchange::getExchangeRate($calc['from'], $calc['to']);
        $rateValue = $exchange->ask;
        $amount = $calc['purchase_value'];
        $exchange = $this->executeTaxes($amount, $rateValue);
        $exchange['from'] = $calc['to'];
        $exchange['to'] = $calc['from'];
        $exchange['to_value'] = $rateValue;
        $exchangeRate = $this->saveCustomerExchange($customer->id, $exchange);
        auth()->user()->sendExchangeRate($exchangeRate);
        return response()->json(['data' => $exchange]);
    }

    protected function saveCustomerExchange(string $customerId, array $exchange)
    {
        return $this->customerExchangeRepository->create([
            'customer_id' => $customerId,
            'exchange'    => $exchange
        ]);
    }

    protected function executeTaxes(float $amount, $rateValue)
    {
        $taxes = $this->getTaxes();


        // ExchangeRate
        $appliedExchangeRate = null;
        if ($amount >= $taxes->taxaConversaoIntervalMin->min)
            $appliedExchangeRate = $taxes->taxaConversaoMin;
        if ($amount <= $taxes->taxaConversaoIntervalMax->min)
            $appliedExchangeRate = $taxes->taxaConversaoMax;
        $exchangeRate = [
            'tax'    => $appliedExchangeRate->value,
            'amount' => $amount / 100//$appliedExchangeRate->getExchageTaxTotal($amount)
        ];
        // cartão
        $creditCard = [
            'tax'    => $taxes->creditCard->value,
            'amount' => $taxes->creditCard->getExchageTaxTotal($amount)
        ];
        $creditCardPurchaseAmount = $amount - ($creditCard['amount'] + $exchangeRate['amount']);
        $creditCard['puchase_amount'] = $creditCardPurchaseAmount;
        $creditCard['puchase_amount_to'] = $creditCardPurchaseAmount / $rateValue;

        //boleto
        $ticket = [
            'tax'    => $taxes->ticket->value,
            'amount' => $taxes->ticket->getExchageTaxTotal($amount)
        ];
        $tiketPurchaseAmount = $amount - ($ticket['amount'] + $exchangeRate['amount']);
        $ticket['puchase_amount'] = $tiketPurchaseAmount;
        $ticket['puchase_amount_to'] = $tiketPurchaseAmount / $rateValue;
        return [
            'exchangeRate' => self::formatNumberArray($exchangeRate),
            'creditCard'   => self::formatNumberArray($creditCard),
            'ticket'       => self::formatNumberArray($ticket),
            'amount'       => self::formatNumberArray($amount)
        ];
    }

    /**
     * @return object
     */
    protected function getTaxes()
    {
        // pega o último setup criado
        $setup = $this->exchangePurchaseSetupRepository->orderBy('created_at', 'desc')->first();

        $taxes = $this->taxRepository->getModel()->where([['setup_id', '=', $setup->id]])->with(['interval'])->get();

        $valorCompra = $taxes->where('name', 'valor_da_compra')->first();
        $valorCompraInterval = $valorCompra->interval()->first();
        $ticket = $taxes->where('name', 'boleto')->first();
        $creditCard = $taxes->where('name', 'cartao_de_credito')->first();
        $taxaConversaoMin = $taxes->where('name', 'taxa_de_conversao_min')->first();
        $taxaConversaoIntervalMin = $taxaConversaoMin ? $taxaConversaoMin->interval()->first() : null;
        $taxaConversaoMax = $taxes->where('name', 'taxa_de_conversao_max')->first();
        $taxaConversaoIntervalMax = $taxaConversaoMax ? $taxaConversaoMin->interval()->first() : null;

        return (object)[
            'purchaseValueIntervalMax' => $valorCompraInterval,
            'purchaseValueIntervalMin' => $valorCompraInterval,
            'ticket'                   => $ticket,
            'creditCard'               => $creditCard,
            'taxaConversaoMin'         => $taxaConversaoMin,
            'taxaConversaoIntervalMin' => $taxaConversaoIntervalMin,
            'taxaConversaoMax'         => $taxaConversaoMax,
            'taxaConversaoIntervalMax' => $taxaConversaoIntervalMax
        ];
    }

    private static function formatNumberArray($toFormat)
    {
        if (is_array($toFormat))
            foreach ($toFormat as $item => $value) {
                $toFormat[$item] = number_format((float)$value, '2', '.', ',');
            }
        if (is_numeric($toFormat)) {
            return number_format((float)$toFormat, '2', '.', ',');
        }
        return $toFormat;
    }
}


