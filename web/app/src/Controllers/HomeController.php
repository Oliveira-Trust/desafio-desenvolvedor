<?php

use Selene\Controllers\BaseController;
use Selene\Render\View;

class HomeController extends BaseController
{
    public function index(): View
    {
        return $this->view()->render(
            'pages/dashboard.html',
            [
                'pageTitle' => 'Dashboard'
            ]
        );
    }
}
