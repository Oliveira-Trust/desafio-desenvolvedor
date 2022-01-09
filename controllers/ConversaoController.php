<?php

namespace app\controllers;

use app\models\Conversao;
use app\models\ConversaoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ConversaoController implements the CRUD actions for Conversao model.
 */
class ConversaoController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Conversao models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ConversaoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionCotacaoAtual($moeda)
    {
        $this->layout = false;
        $cotacaoMoeda = Conversao::getCotacaoMoeda($moeda);
        
        return $cotacaoMoeda;
    }
    
    public function actionValorConvertido($valororigem, $cotacaoatual, $formadepagamento)
    {
        $this->layout = false;
        $model = new Conversao();
        $model->valororigem = $valororigem;
        $model->cotacaoatual = $cotacaoatual;
        $model->formadepagamento = $formadepagamento;
        
        $valor = number_format($model->calcularValorConvertido(), 2, '.', '');
        $taxas = number_format(($model->calcularTaxaPagamento() + $model->calcularTaxaConversao()), 2, '.', '');
        
        return json_encode(['valor' => $valor, 'taxas' =>$taxas]);
    }

    /**
     * Displays a single Conversao model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Conversao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Conversao();
        $model->moedaorigem = 'BRL';
        
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                
                /* Fazer o envio de email */
                
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'listaMoedas' => $model->getMoedas(),
            'listaFormaPagamento' => $model->getFormaPagamento()
        ]);
    }

    /**
     * Updates an existing Conversao model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Conversao model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Conversao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Conversao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Conversao::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
