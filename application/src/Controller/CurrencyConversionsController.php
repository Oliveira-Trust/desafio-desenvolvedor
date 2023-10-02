<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * CurrencyConversions Controller
 *
 * @property \App\Model\Table\CurrencyConversionsTable $CurrencyConversions
 */
class CurrencyConversionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->CurrencyConversions->find()->contain('Users')->orderByDesc('CurrencyConversions.created');
        $currencyConversions = $this->paginate($query);

        $this->set(compact('currencyConversions'));
    }

    /**
     * View method
     *
     * @param string|null $id Currency Conversion id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $currencyConversion = $this->CurrencyConversions->get($id, contain: ['Users']);
        $this->set(compact('currencyConversion'));
    }
}
