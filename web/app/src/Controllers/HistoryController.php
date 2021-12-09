<?php

use Selene\Controllers\BaseController;
use Selene\Render\View;

class HistoryController extends BaseController
{
    public function index(): View
    {
        return $this->view()->render(
            'pages/history.html',
            [
                'pageTitle' => 'Histórico'
            ]
        );
    }
}
