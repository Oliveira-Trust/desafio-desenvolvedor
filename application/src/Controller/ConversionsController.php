<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Mailer\Mailer;
use Cake\View\JsonView;
use Cake\Http\Client;
use Cake\I18n\Number;
use Cake\Http\Client\Request as ClientRequest;

/**
 * Conversions Controller
 *
 */
class ConversionsController extends AppController {

    public function viewClasses(): array {
        return [JsonView::class];
    }

    /**
     * View method
     *
     * @param string|null $id Conversion id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function convert() {

        $originCurrency = $this->request->getData('origin_currency');
        $destinationCurrency = $this->request->getData('destination_currency');
        $valueToConvert = $this->request->getData('value_to_convert');
        $paymentMethodId = $this->request->getData('payment_method_id');
        $email = ($this->Authentication->getResult()->isValid()) ?
                $this->Authentication->getResult()->getData()->email :
                $this->request->getData('email');

        if ($valueToConvert >= 1000 && $valueToConvert <= 100000) {
            if ($this->_validateAvailableCombination($originCurrency, $destinationCurrency)) {
                $paymentMethod = $this->fetchTable('PaymentMethods')->get($paymentMethodId);
                $retCotation = $this->_getContation($originCurrency, $destinationCurrency);
                $paymentTax = $valueToConvert * $paymentMethod->percent_value / 100;
                $conversionTax = ($valueToConvert < 3000) ? $valueToConvert * 0.02 : $valueToConvert * 0.01;
                $conversionValueWithoutTax = $valueToConvert - $paymentTax - $conversionTax;

                $data = [
                    'origin_currency' => $originCurrency,
                    'destination_currency' => $destinationCurrency,
                    'value_to_convert' => (float) $valueToConvert,
                    'payment_method' => $paymentMethod->name,
                    'destination_currency_conversion_value' => (float)$retCotation[$originCurrency . $destinationCurrency]['bid'],
                    'destination_currency_purchased_value' => $conversionValueWithoutTax * $retCotation[$originCurrency . $destinationCurrency]['bid'],
                    'payment_tax' => (float)$paymentTax,
                    'conversion_tax' => (float)$conversionTax,
                    'conversion_value_without_tax' => (float)$conversionValueWithoutTax
                ];

                $this->_saveConversion($data);
                if (!empty($email)) {
                    $this->_sendMailConversion($email, $data);
                }

                $this->set('status', 200);
                $this->set('data', $data);
                $this->set('message', 'success');
            } else {
                $this->set('status', 404);
                $this->set('data', '');
                $this->set('message', 'Combinação para conversão indisponível');
            }
        } else {
            $this->set('status', 404);
            $this->set('data', '');
            $this->set('message', 'Informe um valor de compra maior que R$ 1.000 e menor que R$ 100.000,00 para calcular a conversão.');
        }

        $this->viewBuilder()->setClassName("Json")->setOption('serialize', ['status', 'data', 'message']);
    }

    protected function _validateAvailableCombination($originCurrency, $destinationCurrency) {
        $http = new Client();
        $response = $http->get(AWESOME_API_AVAILABLE_COMBINATIONS);
        $availableCombinations = $response->getJson();

        if (array_key_exists($originCurrency . '-' . $destinationCurrency, $availableCombinations)) {
            return true;
        } else {
            return false;
        }
    }

    protected function _getContation($originCurrency, $destinationCurrency) {
        $http = new Client();
        $response = $http->get(AWESOME_API_COTATION . $originCurrency . '-' . $destinationCurrency);
        return $response->getJson();
    }

    protected function _saveConversion($data) {
        $result = $this->Authentication->getResult();

        if ($result && $result->isValid()) {
            $data['user_id'] = $result->getData()->id;
            $currencyConversion = $this->fetchTable('CurrencyConversions')->newEmptyEntity();
            $currencyConversion = $this->fetchTable('CurrencyConversions')->patchEntity($currencyConversion, $data);

            return $this->fetchTable('CurrencyConversions')->save($currencyConversion);
        }
    }

    protected function _sendMailConversion($email, $data) {
        $mailer = new Mailer('default');
        $mailer->setTransport('default');
        $mailer->setEmailFormat('html');
        $mailer->viewBuilder()->setTemplate('conversion');
        $mailer->setFrom(['noreply@desafiodesenvolvedor.com.br' => 'Desafio Desenvolvedor OT'])
                ->setTo($email)
                ->setSubject('Conversão de Moeda');

        $content = '<h3>Conversão de Moeda</h3>' .
                '<p>Moeda de origem: ' . $data['origin_currency'] . '</p>' .
                '<p>Moeda de destino: ' . $data['destination_currency'] . '</p>' .
                '<p>Valor para conversão: ' . Number::currency($data['value_to_convert'], $data['origin_currency']) . '</p>' .
                '<p>Forma de pagamento: ' . $data['payment_method'] . '</p>' .
                '<p>Valor da "Moeda de destino" usado para conversão: ' . Number::currency($data['destination_currency_conversion_value'], $data['destination_currency']) . '</p>' .
                '<p>Valor comprado em "Moeda de destino": ' . Number::currency($data['destination_currency_purchased_value'], $data['destination_currency']) . '</p>' .
                '<p>Taxa de pagamento: ' . Number::currency($data['payment_tax'], $data['origin_currency']) . '</p>' .
                '<p>Taxa de conversão: ' . Number::currency($data['conversion_tax'], $data['origin_currency']) . '</p>' .
                '<p>Valor utilizado para conversão descontando as taxas: ' . Number::currency($data['conversion_value_without_tax'], $data['origin_currency']) . '</p>';

        $mailer->deliver($content);
    }

    public function beforeFilter(\Cake\Event\EventInterface $event) {
        parent::beforeFilter($event);

        $this->Authentication->addUnauthenticatedActions(['convert']);
    }
}
