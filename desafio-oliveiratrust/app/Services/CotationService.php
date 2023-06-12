<?php

namespace App\Services;

use App\Http\Requests\CotationRequest;
use App\Models\Cotation;
use App\Repositories\CotationRepository;
use Exception;
use Illuminate\Support\Facades\Auth;

class CotationService
{
    protected $cotationRepository;
    protected $economiaApiService;
    protected $settingService;

    public function __construct(CotationRepository $cotationRepository, EconomiaApiService $economiaApiService, SettingService $settingService)
    {
        $this->cotationRepository = $cotationRepository;
        $this->economiaApiService = $economiaApiService;
        $this->settingService = $settingService;
    }

    public function getAllCotations()
    {
        return $this->cotationRepository->getAllCotations();
    }

    public function getAllCotationsByUserId()
    {
        return $this->cotationRepository->getAllCotationsByUserId(Auth::id());
    }

    public function getCotationById(int $id)
    {
        return $this->cotationRepository->getCotationById($id);
    }

    protected function getValueCurrencyDestination(string $originCurrency, string $originDest)
    {
        $tax = $this->economiaApiService->getTaxConversion($originCurrency, $originDest);
        $objectVars = get_object_vars($tax); // o nome do objeto sempre muda, de acordo com a conversão
        $valueDestCurrency = 0;

        foreach ($objectVars as $key => $value) {
            if ($tax->$key->high) {
                $valueDestCurrency = (float)$tax->$key->high;
            } else {
                throw new Exception('Não houve retorno da API para consultar o valor de conversão');
            }
        }

        return $valueDestCurrency;
    }

    protected function getTaxPayment(string $paymentMethod, float $total)
    {
        $perCent = 0;
        $settings = $this->settingService->getLatestSetting();

        if (strtoupper($paymentMethod) == "TICKET") {
            $perCent = $settings->ticket_tax / 100;
        } else if (strtoupper($paymentMethod) == "CREDITCARD") {
            $perCent = $settings->credit_card_tax / 100;
        }

        $valueDisPayment = $total * $perCent;
        return $valueDisPayment;
    }

    protected function getTaxConversion(float $total)
    {
        $settings = $this->settingService->getLatestSetting();

        
        $taxConversion = ($total < 3000) ? ( $settings->conversion_tax_start / 100 )  : ( $settings->conversion_tax_end / 100 );
        $valueDisTaxConvert = $total * $taxConversion;

        return $valueDisTaxConvert;
    }

    protected function getSubTotal(float $total, float $taxConversion, float $taxPayment)
    {
        return $total - $taxConversion - $taxPayment;
    }

    public function save(array $data)
    {
        $cotation = new Cotation();

        // recuperando o valor da moeda de destino
        $valueDestCurrency = $this->getValueCurrencyDestination($data['origin_currency'], $data['destination_currency']);

        // calculando a taxa de pagamento
        $taxPayment = $this->getTaxPayment($data['payment_method'], (float)$data['conversion_amount']);

        // calculando a taxa de conversão
        $taxConversion = $this->getTaxConversion((float)$data['conversion_amount']);

        $subTotal = $this->getSubTotal((float)$data['conversion_amount'], $taxConversion, $taxPayment);

        $totalConvert = $subTotal * $valueDestCurrency;

        $cotation->origin_currency      = $data['origin_currency']; // moeda de origem
        $cotation->destination_currency = $data['destination_currency']; // moeda de destino
        $cotation->conversion_amount    = (float)$data['conversion_amount']; // valor a ser convertido
        $cotation->payment_method       = $data['payment_method']; // forma de pagamento
        $cotation->currency_rate        = $valueDestCurrency; // valor da moeda de destino
        $cotation->purchase_amount      = $totalConvert; // valor comprado na moeda de destino
        $cotation->payment_fee          = $taxPayment; // taxa de pagamento
        $cotation->conversion_fee       = $taxConversion; // taxa de pagamento
        $cotation->amount_minus_fee     = $subTotal; // total na moeda de origem
        $cotation->user_id              = Auth::id();


        return $this->cotationRepository->save($cotation);
    }
}
