<?php

use Selene\Controllers\BaseController;
use Selene\Render\View;

class CurrencyController extends BaseController
{
    public function index(): View
    {
        return $this->view()->render(
            'pages/currency.html',
            [
                'pageTitle' => 'Conversor de Moedas'
            ]
        );
    }
}
