<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class SiteController extends Controller
{
    /**
     * Exibe a página inicial.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->redirect('conversao/index');
    }

}
